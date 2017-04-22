@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-12" >
			<textarea id="salida" name="salida" style="width:50%; height:300px; margin: 0 auto; display:block;" disabled>
<?= $output ?>
			</textarea>
		</div>
	</div> 
	<br/>
	<div style="margin: 0 auto; text-align:center">
		{!! Html::link('/', 'Volver', array('class' => 'btn btn-info btn-lg')); !!}
	</div>
@stop
