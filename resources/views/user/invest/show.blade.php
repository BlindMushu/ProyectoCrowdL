@extends('admin.template.main')

@section('title', 'Listado de pagos de la inversion ' . $invest->id)

@section('content')

	<div>
		<table class="table table-striped">
		<thead>
			@foreach($collection as $dato)
			<th>Ganancia total</th>
			<th>{{$dato['profit']}} Bs.</th>
			<th>Capital total</th>
			<th>{{$dato['capital']}} Bs.</th>
			@endforeach
		</thead>

	</table>
	</div>

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
					<td>{{$payment->interest_amount}} Bs.</td>
					<td>{{$payment->capital_amount}} Bs.</td>
					<td>{{$payment->pay}} Bs.</td>
					<td>{{$payment->balance}} Bs.</td>
					<td><span class="badge bg-primary">PENDIENTE</span></td>
				</tr>

				@else

				<tr>
					<td>{{$payment->interest_amount}} Bs.</td>
					<td>{{$payment->capital_amount}} Bs.</td>
					<td>{{$payment->pay}} Bs.</td>
					<td>{{$payment->balance}} Bs.</td>
					<td><span class="badge bg-success">PAGADO</span></td>
				</tr>

				@endif

			@endforeach
		</tbody>
	</table>

@endsection
