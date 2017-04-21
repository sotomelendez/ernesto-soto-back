<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Routing\Controller;

use \Exception as Exception;

class CubeController extends Controller
{
	//
	public function home()
	{
		return view('cube.index');
	}
	
	public function result(Request $request)
	{
		$entrada = $request->input('entrada');
		
		$output = '';
		try{
			$instructions = explode(PHP_EOL,$entrada);
			
			$actualLine = 0;
			
			$line = $instructions[$actualLine];
			$actualLine++;
			$T = intval($line);
			
			if($T > 50 || $T < 1){
				throw new Exception('La cantidad de casos de prueba está fuera del rango.');	
			}
			for($i = 0; $i < $T; $i++)
			{
				$line = $instructions[$actualLine];
				$actualLine++;
				$parts = explode(" ",$line);
				$N = intval($parts[0]);

				if($N > 100 || $N < 1){
					throw new Exception('El tamaño del cubo está fuera del rango.');	
				}
				
				$cube = array();
				
				$M = intval($parts[1]);
				if($M > 1000 || $M < 1){
					throw new Exception('La cantidad de operaciones está fuera del rango.');	
				}
				for($j = 0; $j < $M; $j++)
				{
					$line = $instructions[$actualLine];
					$actualLine++;
					$operation = explode(" ",$line);
					$x1 = intval($operation[1]);
					$y1 = intval($operation[2]);
					$z1 = intval($operation[3]);
					if($x1 < 1 || $y1 < 1 || $z1 < 1 || $x1 > $N || $y1 > $N || $z1 > $N){
						throw new Exception('La posición está fuera del rango.');
					}
					if($operation[0] == "UPDATE")
					{
						$W = doubleval($operation[4]);
						if($W > 1000000000 || $W < 0.000000001){
							throw new Exception('El valor de actualización está fuera del rango.');	
						}
						$key = str_pad($x1,3,'0',STR_PAD_LEFT) . str_pad($y1,3,'0',STR_PAD_LEFT) . str_pad($z1,3,'0',STR_PAD_LEFT);
						$cube[$key] = $W;
					}
					else if($operation[0] == "QUERY")
					{
						$sum = 0;
						$x2 = intval($operation[4]);
						$y2 = intval($operation[5]);
						$z2 = intval($operation[6]);
						if($x2 < $x1 || $y2 < $y1 || $z2 < $z1 || $x2 > $N || $y2 > $N || $z2 > $N){
							throw new Exception('La posición está fuera del rango.');	
						}
						foreach ($cube as $key => $value) {
							$a = intval(substr($key, 0,3));
							$b = intval(substr($key, 3,3));
							$c = intval(substr($key, 6,3));
							if($x1 <= $a && $a <= $x2 && 
								$y1 <= $b && $b <= $y2 &&
								$z1 <= $c && $c <= $z2)
							{
								$sum = $sum + $value;
							}
						}

						$output = $output . strval($sum) . PHP_EOL;
					}
				}
			}

			if($output == '')
			{
				$output = "Se produjo un error. Puede que los datos de entrada no tengan el formato correcto.";
			}
			return view('cube.result', ['output' => $output]);
		}
		catch(\Exception $ex)
		{
			$output = "Se produjo un error. Puede que los datos de entrada no tengan el formato correcto." . PHP_EOL . $ex->getMessage();
			return view('cube.result', ['output' => $output]);
		}
	}
	
}
