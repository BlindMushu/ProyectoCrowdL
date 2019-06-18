@extends('admin.template.main')

@section('title', 'Agregar articulo')
<br>
<style>
	.sinborde {
    border: 0;
  }
</style>
@section('content')
{!!Form::open(['route' => 'articles.store', 'method' =>'POST', 'files' => true])!!}
	<div class="form-group">
		{!!Form::label('title','Titulo')!!}
		{!!Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo del articulo...', 'required'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('category_id', 'Categoria')!!}
		{!!Form::select('category_id', $categories, null, ['class' => 'form-control select-category', 'required'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('content', 'Contenido')!!}
		{!!Form::textarea('content', null,['class' => 'form-control textarea-content','placeholder' => 'Establezca los motivos de su proyecto, minimo 60 caracteres.', 'name' => 'texto', 'onKeyDown' => 'cuenta()','onKeyUp' =>'cuenta()' ])!!}
		Caracteres: <input type="text" class="sinborde" name="caracteres" size=4, readonly>

	</div>

	<div class="form-group">
		{!!Form::label('amount', 'Monto')!!}
		{!!Form::text('amount', null,['class' => 'form-control', 'placeholder' => 'Introduzca el monto de su inversion en Bs.'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('years', 'Meses')!!}
		{!!Form::text('years', null,['class' => 'form-control', 'placeholder' => 'Indique cuanto tiempo durara su proyecto en meses.'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('tags', 'Garantias')!!}
		{!!Form::select('tags[]',$tags, null, ['class'=>'form-control select-tag', 'required', 'multiple'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('image', 'Imagen')!!}
		{!!Form::file('image')!!}
	</div>
	<div class="form-group">
		{!!Form::submit('Agregar articulo', ['class' => 'btn btn-primary'])!!}
	</div>
{!!Form::close()!!}
@endsection

@section('js')
<script>
	$('.select-tag').chosen({
		placeholder_text_multiple: 'Seleccione un maximo de 3 garantias',
		max_selected_options: 3,
		search_contains : true,
		no_results_text: 'No se encontrar resultados para '
	});

	$('.select-category').chosen({
		placeholder_text_single: 'Seleccione una categoria...'
	});

</script>
@endsection
