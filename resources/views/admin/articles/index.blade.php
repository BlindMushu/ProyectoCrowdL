@extends('admin.template.main')

@section('title', 'Listado de proyectos')

@section('content')
	<a href="{{ route('articles.create')}}" class="btn btn-info">Registrar nuevo proyecto</a>

	{!!Form::open(['route' => 'articles.index', 'method' => 'GET', 'class' => 'navbar-form pull-right'])!!}

			<div class="input-group">

				{!!Form::text('title', null ,['class' => 'form-control', 'placeholder' => 'Buscar proyecto...', 'aria-describedby' => 'search'])!!}
				<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
			</div>
		{!!Form::close()!!}

	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Titulo</th>
			<th>Categoria</th>
			<th>User</th>
			<th>Accion</th>
		</thead>

		<tbody>
			@foreach($articles as $article)
				<tr>
					<td>{{$article->id}}</td>
					<td>{{$article->title}}</td>
					<td>{{$article->category->name}}</td>
					<td>{{$article->user->name}}</td>
					<td>

							<a href="{{route('admin.articles.edit', $article->id)}}" class="btn btn-warning">
								<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
							</a>


							<a href="{{route('admin.articles.destroy', $article->id)}}" class="btn btn-danger">
								<span onclick="Seguro que deseas eliminarlo?" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
							</a>

							<a href="{{route('pays.show', $article->id)}}" class="btn btn-success">
								<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
							</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		{!!$articles->render()!!}
	</div>
@endsection