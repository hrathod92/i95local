<fieldset>
	<legend>Customer Info</legend>
	<div class="form-flex">
		<div class="flex-item">
			<div class="flex-container">
				{!! Form::label('first_name', 'First Name') !!}
				{!! Form::text('first_name') !!}
			</div>
		</div>
		<div class="flex-item">
			<div class="flex-container">
				{!! Form::label('last_name', 'Last Name') !!}
				{!! Form::text('last_name') !!}
			</div>
		</div>
	</div>
	<div class="form-flex">
		<div class="flex-item">
			<div class="flex-container">
				{!! Form::label('company_name', 'Company Name') !!}
				{!! Form::text('company_name') !!}
			</div>
		</div>
		<div class="flex-item">
			<div class="flex-container">
				{!! Form::label('email', 'Email') !!}
				{!! Form::text('email') !!}
			</div>
		</div>
		<div class="flex-item">
			<div class="flex-container">
				{!! Form::label('phone', 'Phone') !!}
				{!! Form::text('phone') !!}
			</div>
		</div>
	</div>
</fieldset>