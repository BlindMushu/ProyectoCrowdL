@extends('admin.template.main')

@section('title','Pagar cuota #'. $payment->num_pay)

@section('content')
	{!! Form::open(['route' => ['pays.update', $payment], 'method' => 'PUT'])!!}
		<div class="form-group">
			{!! Form::label('id', 'ID')!!}
			{!! Form::text('id', $payment->id, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>

		<div class="form-group">
			{!! Form::label('pay', 'Cantidad a pagar')!!}
			{!! Form::text('pay', $payment->pay, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>
		<div class="form-group">
		{{Form::hidden('flag_if_payed', 1,['class' => 'form-control'])}}
		</div>

		<div class="form-group">
			{!! Form::submit('Pagar', ['class' => 'btn btn-success'])!!}
		</div>

	{!! Form::close()!!}
@endsection