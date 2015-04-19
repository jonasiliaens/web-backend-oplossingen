<div class="form-group">
	{!! Form::label('item', 'Wat moet er gedaan worden?') !!}
	{!! Form::text('item', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
