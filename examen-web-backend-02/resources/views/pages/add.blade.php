@extends('app')

@section('content')

	<h1>Voeg een TODO-item toe</h1>

	<p><a href="{{ url('/todos') }}">Terug naar mijn TODO's</a></p>

	{!! Form::open(['url' => 'todos']) !!}
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					@include('pages.form', ['submitButtonText' => 'Toevoegen'])
				</div>
			</div>
		</div>
	{!! Form::close() !!}

@stop