@extends('admin.template.main')

@section('title', 'Listado de inversiones en venta')

@section('content')
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Titulo</th>
			<th>Monto</th>
			<th>Accion</th>
		</thead>

		<tbody>
			@foreach($collection as $d)
				<tr>
					<td>{{$d['id']}}</td>
					<td>{{$d['title']}}</td>
					<td>{{$d['amount']}}</td>
					<td>
							<?php $id=$d['id'] ?>
							<a href="{{route('trades.edit', $id)}}" class="btn btn-success"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
							</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
{!!$collection->render()!!}
@endsection
