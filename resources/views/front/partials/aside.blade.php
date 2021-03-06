<div class="panel panel-primary">
	<div class=panel-heading>
		<h3 class="panel-title">Categorias</h3>
	</div>
	<div class="panel-body">
		<ul class="list-group">
			@foreach($categories as $category)
			<li class="list-group-item">
				<span class=badge>{{$category->articles->count()}}</span>
				<a href="{{route('front.search.category', $category->name)}}">
					{{$category->name}}
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div>
