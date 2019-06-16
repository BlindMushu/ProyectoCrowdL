@extends('admin.template.main')

@section('title', 'Listado de proyectos')

<style>
	.card {
    font-size: 1em;
    overflow: hidden;
    padding: 5;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    margin-top:20px;
}
.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}
</style>>
@section('content')
	<a href="{{ route('articles.create')}}" class="btn btn-info">Registrar nuevo proyecto</a>

	{!!Form::open(['route' => 'articles.index', 'method' => 'GET', 'class' => 'navbar-form pull-right'])!!}

			<div class="input-group">

				{!!Form::text('title', null ,['class' => 'form-control', 'placeholder' => 'Buscar proyecto...', 'aria-describedby' => 'search'])!!}
				<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
			</div>
		{!!Form::close()!!}


	<div class="text-center">
		{!!$articles->render()!!}
	</div>

@foreach($articles as $article)
	<div class="card">
    <div class="row ">

    	<div class="col-md-5">
        <div id="CarouselTest" class="carousel slide" data-ride="carousel">

          <div class="carousel-inner">
            <div class="carousel-item active">
            	@foreach($article->images as $image)
              <img class="img-responsive img-article" src="{{asset('images/articles/' . $image->name)}}" alt="">
              	@endforeach
            </div>
          </div>
        </div>
      </div>

	    <div class="col-md-7 px-3">
	        <div class="card-block px-6">

	        	<center><h3 class="card-title">	{{$article->title}}</h3></center>

	        <table class="table table-borderless">
	        	<thead>
	        		<th><center>Categoria</center></th>
	        		<th><center>Interes</center></th>
	        		<th><center>Monto solicitado</center></th>
	        		<th><center>Monto recaudado</center></th>
	        	</thead>
	        	<tbody>
	        		<td><center>{{$article->category->name}}</center></td>
	        		<td><center>{{$article->interest}} %</center></td>
	        		<td><center>{{$article->amount}} Bs.</center></td>
	        		<td><center>{{$article->amount}} Bs.</center></td>
	        	</tbody>
	        </table>
	        <br>
	        <center>

	        <a href="{{route('admin.articles.edit', $article->id)}}" class="btn btn-primary">
									<span aria-hidden="true">Editar</span>
								</a>

			<a href="{{route('pays.show', $article->id)}}" class="btn btn-primary">
									<span aria-hidden="true">Pagar</span>
								</a>
			<a href="{{route('admin.articles.show', $article->id)}}" class="btn btn-primary">
									<span aria-hidden="true">Inversores</span>
								</a>
			</center>
	        </div>
	      </div>
      <!-- Carousel start -->

      <!-- End of carousel -->
    </div>
  </div>
  @endforeach
@endsection
