@extends('admin.template.main')

@section('title','Pagar cuota #'. $payment->num_pay)
<br>
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
			<input class="btn btn-primary" onclick="return confirm_pay()" type="submit" value="Pagar">
		</div>

	{!! Form::close()!!}

<script type="text/javascript">
function confirm_pay() {
  return confirm('Esta seguro que quiere pagar?');
}
</script>

@endsection