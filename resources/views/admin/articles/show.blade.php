@extends('admin.template.main')

@section('title', 'Listado de Inversores')
<br>
@if(Auth::user()->id === $article->user_id)
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
					<td>{{$d['amount']}} Bs.</td>
					<td>{{$d['date']}}</td>
				</tr>
				@endforeach
		</tbody>
	</table>
@endsection
@else
	@section('content')
		<li class="list-group-item list-group-item-danger">Estas tratanto de acceder a un proyecto que no es tuyo y se te ha denegado el accesso.</li>
	@endsection
@endif