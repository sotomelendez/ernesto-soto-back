<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prueba Backend</title>
    
    {!! Html::style('assets/css/bootstrap.css') !!}

  </head>
  <body>

    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">
    			<h3 class="text-primary text-center">
    				Prueba Cube Summation
    			</h3>
    			
    			<br/>
                @yield('content')
    			
    		</div>
    	</div>
    </div>


	{!! Html::script('assets/js/bootstrap.min.js') !!}
	
	@yield('scripting')
  </body>
</html>