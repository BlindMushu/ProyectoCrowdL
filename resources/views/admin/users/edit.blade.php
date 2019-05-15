@extends('admin.template.main')



@section('title','Editar usuario ' . $user->name)

@section('content')

	{!! Form::open(['route' => ['users.update', $user], 'method' => 'PUT'])!!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre')!!}
			{!! Form::text('name', $user->name, ['class'=>'form-control','placeholder' => 'Nombre Completo', 'required'])!!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Correo Electronico')!!}
			{!! Form::email('email', $user->email, ['class'=>'form-control','placeholder' => 'example@gmail.com', 'required'])!!}
		</div>


		<div class="form-group">
			{!! Form::label('type', 'Tipo de Usuario')!!}
			{!! Form::select('type', [''=>'Seleccione un nivel de usuario...','member'=>'Miembro', 'admin' => 'Administrador'], null, ['class'=>'form-control','required'])!!}
		</div>

		<div class="form-group">
			{!! Form::submit('Editar', ['class'=>'btn btn-primary'])!!}

		</div>

	{!! Form::close()!!}
@endsection