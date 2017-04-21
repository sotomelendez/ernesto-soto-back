@extends('layout')

@section('content')
			
			<!--<form action="result.php" method="POST">-->
			{{ Form::open(array('url' => 'result', 'method' => 'post')) }}
            
			<div class="row">
				<div class="col-md-12" >
					<textarea id="entrada" name="entrada" style="width:50%; height:300px; margin: 0 auto; display:block;"></textarea>
				</div>
			</div> 
			<br/>
			<div style="margin: 0 auto; text-align:center">
				
				<!--<button type="submit" class="btn btn-success btn-lg">
					Ejecutar
				</button> -->
				{{ Form::submit('Ejecutar', array('class' => 'btn btn-success btn-lg')) }}
				<button type="button" class="btn btn-lg btn-danger" onclick="cleanText();">
					Limpiar
				</button>
			</div>
			{{ Form::close() }}
			<!--</form>-->
@stop

@section('scripting')

    <script type="text/javascript">
		function cleanText(){
			document.getElementById('entrada').value = "";
			document.getElementById('entrada').innerHTML = "";
		}
	</script>

@stop