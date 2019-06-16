@extends('admin.template.main')

@section('title','Vender inversion')

@section('content')

	{!! Form::open(['route' => ['invests.update', $invest], 'method' => 'PUT'])!!}
		<div class="form-group">
			{!! Form::label('id', 'ID')!!}
			{!! Form::text('id', $invest->id, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>

		<div class="form-group">
			{!! Form::label('title', 'Nombre del proyecto')!!}
			{!! Form::text('title', $article->title, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>

		<div class="form-group">
			{!! Form::label('amount', 'Monto invertido')!!}
			{!! Form::text('amount', $invest->amount, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>
		<div class="form-group">
		{{Form::hidden('user_id', $invest->user_id ,['class' => 'form-control'])}}
		{{Form::hidden('article_id', $invest->article_id ,['class' => 'form-control'])}}
		{{Form::hidden('flag_if_sale', 1,['class' => 'form-control'])}}
		</div>
		<div class="form-group">
		{!! Form::label('amount_sale', 'Precio de venta')!!}
		{!! Form::number('amount_sale', $invest->amount_sale, ['class' => 'form-control', 'required' , 'min' => '1', 'max' => $maximo , 'placeholder' => $maximo])!!}
		</div>


		<div class="form-group">
			<input class="btn btn-primary" onclick="return confirm_delete()" type="submit" value="Vender">
		</div>
	{!! Form::close()!!}

<script type="text/javascript">
function confirm_delete() {
  return confirm('Esta seguro de vender?');
}
</script>
@endsection