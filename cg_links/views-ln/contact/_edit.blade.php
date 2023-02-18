<div class="flex-form">
	<div class="flex-item name">
		{!! Form::label('name', 'Name', array('class' => 'required')) !!}
		{!! Form::text( 'name' ) !!}
	</div>
	<div class="flex-item email">
		{!! Form::label('email', 'Email', array('class' => 'required')) !!}
		{!! Form::text( 'email' ) !!}
	</div>
	<div class="flex-item phone">
		{!! Form::label( 'phone', 'Phone Number' ) !!}
		{!! Form::text( 'phone' ) !!}
	</div>
	<div class="flex-item company-name">
		{!! Form::label( 'company_name', 'Company Name' ) !!}
		{!! Form::text( 'company_name' ) !!}
	</div>
	<div class="flex-item company-email">
		{!! Form::label( 'company_email', 'Company Email' ) !!}
		{!! Form::text( 'company_email' ) !!}
	</div>
	<div class="flex-item comments">
		{!! Form::label( 'comments', 'Comments' ) !!}
		{!! Form::textarea( 'comments' ) !!}
	</div>
</div>