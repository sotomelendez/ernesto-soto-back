<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SummationTest extends TestCase
{
    
    public function testValidarHome(){
        $this->call('GET', '/');
        $this->assertResponseOk();
    }
    
    public function testValidarSuma(){
        $entrada = '1' . PHP_EOL . '4 5' . PHP_EOL . 'UPDATE 2 2 2 4' . PHP_EOL . 'QUERY 1 1 1 3 3 3' . PHP_EOL . 'UPDATE 1 1 1 23' . PHP_EOL . 'QUERY 2 2 2 4 4 4' . PHP_EOL . 'QUERY 1 1 1 3 3 3';
        $response = $this->action('POST', 'CubeController@result', ['entrada' => $entrada]);
        $this->assertResponseOk();
        $output = substr($response->original->output,1);
        $this->assertNotEquals($output,'Se produjo un error. Puede que los datos de entrada no tengan el formato correcto.');
        
    }
    
    public function testValidarSuma1(){
        $entrada = '1' . PHP_EOL . '2 4' .PHP_EOL . 'UPDATE 2 2 2 1' . PHP_EOL . 'QUERY 1 1 1 1 1 1' . PHP_EOL . 'QUERY 1 1 1 2 2 2' . PHP_EOL . 'QUERY 2 2 2 2 2 2';
        $response = $this->action('POST', 'CubeController@result', ['entrada' => $entrada]);
        $this->assertResponseOk();
        $output = substr($response->original->output,1);
        $this->assertNotEquals($output,'Se produjo un error. Puede que los datos de entrada no tengan el formato correcto.');
        
    }
    
    public function testValidarError(){
        
        $response = $this->action('POST', 'CubeController@result', ['entrada' => '2\n2 4\nUPDATE 2 2 2 1\nQUERY 1 1 1 1 1 1\nQUERY 1 1 1 2 2 2\nQUERY 2 2 2 2 2 2']);
        $this->assertResponseOk();
        $output = substr($response->original->output,1);
        $this->assertEquals($output,'Se produjo un error. Puede que los datos de entrada no tengan el formato correcto.');
        
    }
    
    public function testValidarError2(){
        
        $response = $this->action('POST', 'CubeController@result', ['entrada' => 'Texto con formato diferente al esperado para la suma.']);
        $this->assertResponseOk();
        $output = substr($response->original->output,1);
        $this->assertEquals($output,'Se produjo un error. Puede que los datos de entrada no tengan el formato correcto.');
        
    }
        
}

