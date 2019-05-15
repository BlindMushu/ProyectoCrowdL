@extends('admin.template.main')

@section('title', 'Listado de pagos de la inversion ' . $invest->id)

@section('content')
	<table class="table table-striped">
		<thead>
			<th>Interes</th>
			<th>Capital</th>
			<th>Pago</th>
			<th>Balance</th>
			<th>Estado</th>
		</thead>
		<tbody>
			@foreach($payments as $payment)

				@if($payment->flag_if_payed == 0)

				<tr>
					<td>{{$payment->interest_amount}}</td>
					<td>{{$payment->capital_amount}}</td>
					<td>{{$payment->pay}}</td>
					<td>{{$payment->balance}}</td>
					<td><span class="badge bg-primary">PENDIENTE</span></td>
				</tr>

				@else

				<tr>
					<td>{{$payment->interest_amount}}</td>
					<td>{{$payment->capital_amount}}</td>
					<td>{{$payment->pay}}</td>
					<td>{{$payment->balance}}</td>
					<td><span class="badge bg-success">PAGADO</span></td>
				</tr>

				@endif

			@endforeach
		</tbody>
	</table>

		{!!$payments->render()!!}
@endsection
