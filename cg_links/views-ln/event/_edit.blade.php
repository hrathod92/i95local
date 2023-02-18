@if ( \Auth::check()  )
  @if ( \Auth::user()->role == 'admin' )
    {!! Form::hidden( 'email', \Auth::user()->email, array('id' => 'email') ) !!}
    {!! Form::hidden( 'user_id', \Auth::user()->id ) !!}
    {!! Form::hidden( 'agree', 'agree' ) !!}
    {!! Form::Label( 'company_id', 'Company' ) !!} 
    {!! Form::select( 'company_id', 
      \App\Company::orderBy( 'id' )->lists( 'title', 'id' )->prepend( 'None', 0 ), 
      !empty( $event->company_id ) ? $event->company_id : 0 ) 
    !!}
  @else
    {!! Form::hidden( 'email', \Auth::user()->email, array('id' => 'email') ) !!}
    {!! Form::hidden( 'user_id', \Auth::user()->id ) !!}
    {!! Form::hidden( 'company_id', \Auth::user()->company_id ) !!}
  @endif
@else
  {!! Form::label('email', 'Submitter Email:'),"<span class='event-create'>(* required)</span>" !!}
  {!! Form::text( 'email' ) !!}
@endif

<h3>Event Info:</h3>
@if ( \Auth::check() && \Auth::user()->role == 'admin' )
  {!! Form::label( 'event_type_id', 'Type') !!}
  {!! Form::select( 'event_type_id', 
    App\EventType::lists( 'title', 'id' ), 
    isset( $event->event_type_id ) ? $event->event_type_id : 20 ) 
  !!}
@else
  {!! Form::label( 'event_type_id', 'Type') !!}
  {!! Form::select( 'event_type_id', 
    App\EventType::where( 'id', '!=', 1 )->lists( 'title', 'id' ), 
    isset( $event->event_type_id ) ? $event->event_type_id : 20 ) 
  !!}
@endif

{!! Form::label( 'title', 'Event Title' ),"<span class='event-create'>(* required)</span>" !!}
{!! Form::text( 'title' ) !!}

{!! Form::label( 'starts_at', 'Event Start Date' ),"<span class='event-create'>(* required)</span>" !!}
{!! Form::text( 'starts_at', !empty($event->starts_at) ? \Carbon\Carbon::parse($event->starts_at)->format('m/d/Y') : null, array('id' => 'datepicker',)) !!}

{!! Form::label( 'ends_at', 'Event End Date' ) !!}
{!! Form::text( 'ends_at', !empty($event->ends_at) ? \Carbon\Carbon::parse($event->ends_at)->format('m/d/Y') : null, array('id' => 'datepicker2',) ) !!}

{!! Form::label( 'location', 'Location' ) !!}
{!! Form::textarea( 'location', null, ['size' => '30x3']) !!}

<!-- {!! Form::label( 'contact', 'Contact Info' ) !!}
{!! Form::textarea( 'contact' ) !!} -->

{!! Form::label( 'url', 'Registration URL (e.g., event.com, http://event.com or https://event.com)' ) !!}
{!! Form::text( 'url' ) !!}

{!! Form::label( 'description', 'Event Description' ) !!}
{!! Form::textarea( 'description' , null) !!}
<br>

{!! Form::label( 'image', 'Event Image (JPG, PNG or GIF)' ) !!}
<p>Current Image : {!! !empty( $event->image ) ? $event->image : 'None' !!}</p>
@if ( !empty( $event->image ))
  {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Image?
@endif
{!! Form::file('image', null) !!}
<br>
{!! Form::label( 'image_size', 'Image Display Size' ) !!}
{!! Form::select('image_size', [
   '25' => '25%',
   '50' => '50%',
   '100' => '100%']
) !!}

{!! Form::label( 'image_alt', 'Image ALT Tag (SEO)' ) !!}
{!! Form::text( 'image_alt' ) !!}

{!! Form::label( 'keywords', 'Keywords' ) !!}
{!! Form::text( 'keywords' ) !!}

<div class="preview">
  <h3>Preview</h3>
	  <div class="preview-block">
	  <div class="pimage">
	    <img id="uploadedimage" /> 
	    <p><span id="imageerror" style="font-weight: bold; color: red"></span></p>
	  </div>
	  <div class="previewtext">
		  <div id="ptitle"></div>
	    <div id="pdate"></div>
	    <div id="plocation"></div>
	    <div id="ptext"></div>
	  </div>
  </div>
</div>

@if ( \Auth::check() && \Auth::user()->role == 'admin' )
  {!! Form::label( 'status_id', 'Status') !!}
  {!! Form::select( 'status_id', \App\Status::lists( 'title', 'id' )) !!}
@endif

@if ( !\Auth::check() )
  <h3>Submitted by:</h3>
  {!! Form::label( 'first_name', 'First Name' ) !!}
  {!! Form::text( 'first_name' ) !!}

  {!! Form::label( 'last_name', 'Last Name' ) !!}
  {!! Form::text( 'last_name' ) !!}

  {!! Form::label( 'contact_title', 'Title' ) !!}
  {!! Form::text( 'contact_title' ) !!}

  {!! Form::label( 'company_name_sub', 'Company Name' ) !!}
  {!! Form::text( 'company_name_sub' ) !!}

  {!! Form::label( 'phone', 'Phone Number' ) !!}
  {!! Form::text( 'phone' ) !!}

  {!! Form::label( 'contact_email', 'Email' ) !!}
  {!! Form::text( 'contact_email' ) !!}
@endif

{!! Form::checkbox('agree', 'agree', null, array('id' => 'agree')) !!} I have read the <a href='/content/terms-of-use' target='_blank'>Terms of Use&nbsp;</a>

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block', 'id' => 'register')) !!}
<script>
  $(document).ready(function() {
    $('.preview').hide();
    $('.pimage').hide();
    
    document.getElementById("datepicker").onchange = function () {
       var start = document.getElementById("datepicker").value;
       $('.preview').show();
       $('#pdate').text(start);
    };
    
    document.getElementById("datepicker2").onchange = function () {
       var start = document.getElementById("datepicker").value;
       var end = document.getElementById("datepicker2").value;
       $('.preview').show();
       $('#pdate').text(start + " - " + end);
    };
    
    document.getElementById("location").onchange = function () {
       var location = document.getElementById("location").value;
       $('.preview').show();
       $('#plocation').text(location);
    };
    
    document.getElementById("title").onchange = function () {
       var title = document.getElementById("title").value;
       $('.preview').show();
       $('#ptitle').text(title);
    };
   
    document.getElementById("image").onchange = function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.preview').show();
            $('.pimage').show();
            if (e.total > 250000000) {
                $('#imageerror').text('Image too large');
                $jimage = $("#image");
                $jimage.val("");
                $jimage.wrap('<form>').closest('form').get(0).reset();
                $jimage.unwrap();
                $('#uploadedimage').removeAttr('src');
                return;
            }
            $('#imageerror').text('');
            document.getElementById("uploadedimage").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    };
    
    CKEDITOR.instances['description'].on('blur', function(e) {
    if (e.editor.checkDirty()) {
      var editor = CKEDITOR.instances.description.getData();
        $('.preview').show();
        $('#ptext').html(editor);
        }
    });
 });
</script>
