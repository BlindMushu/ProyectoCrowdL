@extends('admin.template.main')

@section('title','Listado de proyectos')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="row">

				@foreach($articles as $article)
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-header">
						<a href="{{route('front.view.article', $article->slug)}}" class="thumbnail">
							@foreach($article->images as $image)
							<img class="img-responsive img-article" src="{{asset('images/articles/' . $image->name)}}" alt="...">
							@endforeach
						</a>
						</div>
						<div class="panel-body">
						<a href="{{route('front.view.article', $article->slug)}}" style="color:black">
						<h4 class="text-center">{{$article->title}}</h4>
						</a>
						@foreach($data as $d)
							@if($article->id == $d['article_id'])
								@if($article->amount == $d['amount_collected'])
								<div class="progress">
		  						<div class="progress-bar bg-success" role="progressbar" style="width: {{($d['amount_collected']/$article->amount)*100}}%" aria-valuenow="{{$d['amount_collected']}}" aria-valuemin="0" aria-valuemax="{{$article->amount}}">{{($d['amount_collected']/$article->amount)*100}}%</div>
								</div>
								<center><small>{{$d['amount_collected']}} Bs. reunidos de {{$article->amount}} Bs.</small></center>
								@else
								<div class="progress">
		  						<div class="progress-bar bg-info" role="progressbar" style="width: {{($d['amount_collected']/$article->amount)*100}}%" aria-valuenow="{{$d['amount_collected']}}" aria-valuemin="0" aria-valuemax="{{$article->amount}}">{{($d['amount_collected']/$article->amount)*100}}%</div>
								</div>
								<center><small>{{$d['amount_collected']}} Bs. reunidos de {{$article->amount}} Bs.</small></center>
								@endif()
							@endif

						@endforeach

						<hr>
						<i class="fa fa-older-open-o"></i>
						<a href="{{route('front.search.category', $article->category->name)}}"><small>{{$article->category->name}}</small></a>
						<div class="pull-right">
							<i class="fa fa-clock-c"></i> <small class="text-muted">{{$article->created_at->diffForHumans()}}</small>
						</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>
			<hr>
			<div class="text-center">
				{!!$articles->render()!!}
			</div>
		</div>
		<div class="col-md-4 aside">
			@include('front.partials.aside')
		</div>
	</div>
@endsection