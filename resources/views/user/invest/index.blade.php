@extends('admin.template.main')

@section('title', 'Listado de Inversiones')
<br>

@section('content')
	<a href="{{ route('invests.create')}}" class="btn btn-info">Realizar nueva inversion</a>
	<hr>
		<div class="card-columns">
			@foreach($collection as $d)
			  <div class="card">
			   <img class="img-responsive img-article" src="{{asset('images/articles/' . $d['image'])}}" alt="...">
			    <div class="card-body">
			      <h5 class="card-title">Inversion en {{$d['title']}}</h5>
			      <p class="card-text">Monto invertido: {{$d['amount']}} Bs.</p>
			      <p class="card-text">Total pagado: {{$d['pay']}} Bs.</p>
			      <p class="card-text">Ganancia: {{$d['interest']}} Bs.</p>

			      <center>
			      	<?php $id=$d['id'] ?>
			      	<a href="{{route('invests.edit', $id)}}" class="btn btn-primary">Vender inversion</a>
			      	<a href="{{route('invests.show', $id)}}" class="btn btn-info">Ver lista de Pagos</a>
			      </center>
			    </div>
			  </div>
			@endforeach
		</div>
{!!$collection->render()!!}
@endsection
