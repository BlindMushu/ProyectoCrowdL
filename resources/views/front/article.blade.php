@extends('admin.template.main')
@section('title', $article->title)

@section('content')
<h3 class="title-front left">{{$article->title}}</h3>
<hr>
	<div class="row">
		<div class="col-md-8">
			@foreach($article->images as $image)
			<img class="img-responsive img-article" src="{{asset('images/articles/' . $image->name)}}" alt="...">
			@endforeach
			<hr>
			<div class="container hyphenation text-justified" lang="es">
			{!!$article->content!!}
			</div>
			<hr>
			<h3>Informacion</h3>
			<table border="20" style="border: hidden" >
				<tr style="border: hidden">
				    <th style="border: hidden"><h5>Propietario del proyecto</h5></th>
				    <th style="border: hidden"><h5>Monto total requerido</h5></th>
				    <th style="border: hidden"><h5>Tiempo de pago estimado</h5></th>
				    <th style="border: hidden"><h5>Tasa de interes</h5></th>
  				</tr>
  				<tr style="border: hidden">
				    <td style="border: hidden"><h5>{{$article->user->name}}</h5></td>
				    <td style="border: hidden"><h5>{{$article->amount}} Bs.</h5></td>
				    <td style="border: hidden"><h5>{{$article->years}} años</h5></td>
				    <td style="border: hidden"><h5>{{$article->interest}}%</h5></td>
  				</tr>
			</table>
			<hr>
			<h3>Acciones</h3>
			<table class="table table-striped">
				<tr>
					<div class="form-group">
					<td>
					{!!Form::open(['route' => 'invests.store', 'method' =>'POST'])!!}
					{{Form::hidden('article_id', $article->id ,['class' => 'form-control'])}}
					</td>
					<td>
						@if(Auth::user()->id === $article->user_id)
							{!!Form::number('amount', null,['class' => 'form-control', 'readonly'=>'readonly'])!!}
						@else
							{!!Form::number('amount', null,['class' => 'form-control', 'min' => '1', 'max' => $article->amount - $sum, 'placeholder' => $article->amount - $sum])!!}
						@endif
					</td>
					</div>
					<td>
					<div class="form-group">
					{!!Form::submit('$', ['class' => 'btn btn-success'])!!}
					</div>
					</td>
					{!!Form::close()!!}
				</tr>
			</table>
			<hr>
			<h3>Garantias</h3>
			@foreach($article->tags as $tag)
				{{$tag->name}}
			@endforeach
			<hr>
			<h3>Comentarios</h3>

			<hr>
			<div id="disqus_thread"></div>
<script>
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://proy-sis.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

		</div>
		<div class="col-md-4 aside">
			@include('front.partials.aside')
		</div>
	</div>
@endsection