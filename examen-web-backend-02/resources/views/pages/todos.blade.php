@extends('app')

@section('content')
	<h1>De TODO-app</h1>

	@if(count($todosTodo) || count($todosDone))

		<h2>Wat moet er allemaal gebeuren?</h2>

		<p><a href="{{ url('/todos/add') }}">Voeg item toe.</a></p>

		<h3>Todo</h3>

		@if(count($todosTodo))

			@foreach($todosTodo as $todo)
				<ul class="list">
				    <li class="todo">
				    	<span class="activate" title="Vink maar af">
				    		<a href="{{ url('/todos/toggle', $todo->id) }}" class="icon fontawesome-ok-sign"></a>
				    	</span>
						<span class="text">{{ $todo->item }}</span>
						<span class="delete" title="Verwijder dit maar">
							<a href="{{ url('/todos/delete', $todo->id) }}" class="icon fontawesome-remove"></a>
						</span>
				    </li>
				</ul>
			@endforeach

		@else
			<p>Allright, all done!</p>
		@endif

		<h3>Done</h3>

		@if(count($todosDone))

			@foreach($todosDone as $todo)
				<ul class="list">
				    <li class="done">
				    	<span class="activate" title="Oeps, dit moet nog gedaan worden">
				    		<a href="{{ url('/todos/toggle', $todo->id) }}" class="icon fontawesome-ok-sign"></a>
				    	</span>
						<span class="text">{{ $todo->item }}</span>
						<span class="delete" title="Verwijder dit maar">
							<a href="{{ url('/todos/delete', $todo->id) }}" class="icon fontawesome-remove"></a>
						</span>
				    </li>
				</ul>
			@endforeach

		@else
			<p>Damn, werk aan de winkel...</p>
		@endif

	@else

		<p>Nog geen todo-items. <a href="{{ url('/todos/add') }}">Voeg item toe.</a></p>

	@endif

@stop