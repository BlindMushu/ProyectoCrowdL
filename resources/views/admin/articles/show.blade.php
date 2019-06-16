@extends('admin.template.main')

@section('title', 'Listado de Inversores')

@section('content')

		<hr>
	<table class="table table-hover">
		<thead>
			<th>Nombre del inversionista</th>
			<th>Monto invertido</th>
			<th>Fecha de la inversion</th>
		</thead>

		<tbody>
				@foreach($collection as $d)
				<tr>
					<td>{{$d['nombre']}}</td>
					<td>{{$d['amount']}}</td>
					<td>{{$d['date']}}</td>
				</tr>
				@endforeach
		</tbody>
	</table>
@endsection
