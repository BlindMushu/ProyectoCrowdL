@extends('admin.template.main')

@section('title','Vender inversion')

@section('content')
	{!! Form::open(['route' => ['trades.update', $invest], 'method' => 'PUT'])!!}
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
		{{Form::hidden('user_id', Auth::user()->id ,['class' => 'form-control'])}}
		{{Form::hidden('article_id', $invest->article_id ,['class' => 'form-control'])}}
		{{Form::hidden('flag_if_sale', 0,['class' => 'form-control'])}}
		</div>
		<div class="form-group">
		{!! Form::label('amount_sale', 'Precio de venta')!!}
		{!! Form::text('amount_sale', $invest->amount_sale, ['class' => 'form-control', 'readonly'=>'readonly' ])!!}
		</div>


		<div class="form-group">
			{!! Form::submit('Comprar', ['class' => 'btn btn-primary'])!!}
		</div>
	{!! Form::close()!!}
@endsection