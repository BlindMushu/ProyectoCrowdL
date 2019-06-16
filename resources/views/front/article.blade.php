@extends('admin.template.main')
@section('title', $article->title)

@section('content')
<h3 class="title-front left">{{$article->title}}</h3>
<hr>

			@foreach($article->images as $image)
			<center><img class="img-responsive img-article" src="{{asset('images/articles/' . $image->name)}}" alt="..."></center>
			@endforeach
			<hr>
			<div class="container hyphenation text-justified" lang="es">
			{!!$article->content!!}
			</div>
			<hr>
			<h3>Informacion</h3>
			<table class="table table-borderless" >
				<thead>
				<tr style="border: hidden">
				    <th style="border: hidden"><h5>Propietario del proyecto</h5></th>
				    <th style="border: hidden"><h5>Monto total requerido</h5></th>
				    <th style="border: hidden"><h5>Tiempo de pago estimado</h5></th>
				    <th style="border: hidden"><h5>Tasa de interes</h5></th>
				    <th style="border: hidden"><h5>Monto recaudado</h5></th>
  				</tr>
  				</thead>
  				<tbody>

  				<tr style="border: hidden">
				    <td style="border: hidden"><h5><center>{{$article->user->name}}</center></h5></td>
				    <td style="border: hidden"><h5><center>{{$article->amount}} Bs.</center></h5></td>
				    <td style="border: hidden"><h5><center>{{$article->years}} años</center></h5></td>
				    <td style="border: hidden"><h5><center>{{$article->interest}}%</center></h5></td>
				    <td style="border: hidden"><h5><center>{{$sum}} Bs.</center></h5></td>
  				</tr>
  				</tbody>
			</table>
			<hr>
			<h3>Invertir</h3>
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
							{!!Form::number('amount', null,['class' => 'form-control', 'min' => '1', 'max' => $article->amount - $sum, 'placeholder' => $article->amount - $sum, 'required'])!!}
						@endif

					</td>
					</div>
					<td>Bs.</td>
					<td>
					<div class="form-group">
						@if(Auth::user()->id === $article->user_id)
							{!!Form::submit('Invertir', ['class' => 'btn btn-success', 'disabled'])!!}
						@else
							{!!Form::submit('Invertir', ['class' => 'btn btn-success'])!!}
						@endif
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


@endsection