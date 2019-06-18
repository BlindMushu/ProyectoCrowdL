@extends('admin.template.main')

@section('title', 'Listado de pagos del proyecto ' . $article->title)
<br>
@if(Auth::user()->id === $article->user_id)
	@section('content')
		<table class="table table-striped">
			<thead>
				<th>Nro. Pago</th>
				<th>Interes</th>
				<th>Capital</th>
				<th>Pago</th>
				<th>Balance</th>
				<th>Fecha de Pago</th>
			</thead>
			<tbody>
				@foreach($payments as $payment)

					@if($payment->flag_if_payed == 0)

					<tr>
						<td>{{$payment->num_pay}}</td>
						<td>{{$payment->interest_amount}}</td>
						<td>{{$payment->capital_amount}}</td>
						<td>{{$payment->pay}}</td>
						<td>{{$payment->balance}}</td>
						<td>{{$payment->payday}}</td>
						<td>

								@if($payment->payday == $fecha_actual)
									<a href="{{route('pays.edit', $payment->id)}}" class="btn btn-success">
									<span aria-hidden="true">Pagar</span>
									</a>
								@else
									<a href="" class="btn btn-secondary">
									<span aria-hidden="true">Pagar</span>
									</a>
								@endif

						</td>
					</tr>

					@else

					<tr>
						<td>{{$payment->num_pay}}</td>
						<td>{{$payment->interest_amount}}</td>
						<td>{{$payment->capital_amount}}</td>
						<td>{{$payment->pay}}</td>
						<td>{{$payment->balance}}</td>
						<td>{{$payment->payday}}</td>
						<td>PAGADO</td>
					</tr>

					@endif

				@endforeach
			</tbody>
		</table>

			<center>{!!$payments->render()!!}</center>
	@endsection
@else
	@section('content')
		<li class="list-group-item list-group-item-danger">Accesso denegado.</li>
	@endsection
@endif
