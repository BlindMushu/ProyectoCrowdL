@extends('admin.template.main')

@section('title', 'Listado de Inversiones')

@section('content')
	<a href="{{ route('invests.create')}}" class="btn btn-info">Realizar nueva inversion</a>

	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Titulo</th>
			<th>Monto</th>
			<th>Total Pagado</th>
			<th>Ganancias</th>
			<th>Accion</th>
		</thead>

		<tbody>
			@foreach($collection as $d)
				<tr>
					<td>{{$d['id']}}</td>
					<td>{{$d['title']}}</td>
					<td>{{$d['amount']}}</td>
					<td>{{$d['pay']}}</td>
					<td>{{$d['interest']}}</td>
					<td>
							<?php $id=$d['id'] ?>
							<a href="{{route('invests.edit', $id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
							</a>
					</td>
					<td>
							<?php $id=$d['id'] ?>
							<a href="{{route('invests.show', $id)}}" class="btn btn-info"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
							</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
{!!$collection->render()!!}
@endsection
