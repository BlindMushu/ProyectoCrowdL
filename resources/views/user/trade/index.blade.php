@extends('admin.template.main')
<br>
@section('title', 'Listado de inversiones en venta')

@section('content')
<div class="card-columns">
@foreach($collection as $d)
  <div class="card">
   <img class="img-responsive img-article" src="{{asset('images/articles/' . $d['image'])}}" alt="...">
    <div class="card-body">
      <h5 class="card-title">Inversion en {{$d['title']}}</h5>
      Precio de compra: {{$d['amount']}} Bs. <br>
      Propietario: {{$d['name']}}
      <p class="card-text"><small class="text-muted">{{$d['date']->diffForHumans()}}</small></p>

      <center>
      	<?php $id=$d['id'] ?>
      	<a href="{{route('trades.edit', $id)}}" class="btn btn-success">Comprar</a>
      </center>
    </div>
  </div>
@endforeach
</div>
<center>{!!$collection->render()!!}</center>
@endsection
