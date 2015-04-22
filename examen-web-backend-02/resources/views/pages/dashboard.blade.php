@extends('app')

@section('content')
	<h1>Welkom op het dashboard {{ Auth::user()->name }}</h1>
	<p>Dit is de applicatie die je moet maken: <a href="{{ url('/todos') }}">Todo-applicatie</a></p>
@stop