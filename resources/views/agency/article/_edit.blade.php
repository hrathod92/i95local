<?php
  $user = Auth::user();
?>


<div class="form-element">
  {!! Form::label( 'title', 'Title' ) !!}
  {!! Form::text( 'title' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'tagline', 'Tagline' ) !!}
  {!! Form::text( 'tagline' ) !!}
</div>

{!! Form::hidden('company_id', $id) !!}

<?php 
	$selectAuthors = \App\Author::where( 'company_id', $id )->orderBy( 'title' )->pluck( 'title', 'id' )->prepend( 'None', 0 );
?>
<div class="form-element">
  {!! Form::Label( 'author_id', 'Author' ) !!} 
  {!! Form::select( 'author_id', $selectAuthors, isset( $article->author_id ) ? $article->author_id : '' ) !!}
</div>

<?php $emailQueueStatuses = \App\EmailQueueStatus::orderBy( 'id' )->pluck( 'title', 'id' ) ?>
<div class="form-element">
  {!! Form::Label( 'email_queue_status_id', 'Email Queue Status' ) !!}
  {!! Form::select( 'email_queue_status_id', $emailQueueStatuses, isset( $article->email_queue_status_id ) ? $article->email_queue_status_id : 0 ) !!}
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $( "#company_id" ).change(function() {
      var id = $(this).val();
      dataString = 'company_id=' + id;
      $.ajax({
        type: "POST",
        url: "/authors/api/get-company-authors/" + id,
        data: dataString,
        cache: false,
        success: function( html ) {   
          $( "#author_id" ).html( html.html );
        } 
      });
    });
  });
</script>

<div class="form-element">
  {!! Form::label( 'pub_date', 'Publication Date' ) !!}
  {!! Form::date( 'pub_date' ) !!}
</div>

<div class="form-element">
  {!! Form::Label( 'newsletter_id', 'Issue Date' ) !!} 
  {!! Form::select( 'newsletter_id', \App\Newsletter::orderBy( 'title', 'desc' )->pluck( 'title', 'id' )->prepend( 'None', 0 ), isset( $article->newsletter_id ) ? $article->newsletter_id : '' ) !!}
</div>

<?php 
	$categoriesCollection = \App\Category::select( 'categories.*' )
		->join( 'categories AS parents', 'categories.parent_id', '=', 'parents.id' )
		->where( 'categories.slug', '!=', 'none' )
		->where( 'categories.status_id', 0 )
		->orderBy( 'parents.title' )
		->orderBy( 'categories.level' )
		->orderBy( 'categories.title' )
		->get();
	$categories[0] = 'NONE';
	foreach ( $categoriesCollection AS $key => $value ) {
		if ( $value->level == 0 ) {
			$categories[$value->id] = strtoupper( $value->title );
		} else {
			$categories[$value->id] = '&nbsp;&nbsp;&nbsp;' . $value->title;
		}
	}
?>

<div class="form-element">
  {!! Form::Label( 'category_id', 'Category 1' ) !!} 
  {!! Form::select( 'category_id', $categories, isset( $article->category_id ) ? $article->category_id : 0 ) !!}
</div>

<div class="form-element">
  {!! Form::Label( 'category_2_id', 'Category 2' ) !!} 
  {!! Form::select( 'category_2_id', $categories, isset( $article->category_2_id ) ? $article->category_2_id : 0 ) !!}
</div>

<div class="form-element">
  {!! Form::Label( 'category_3_id', 'Category 3' ) !!} 
  {!! Form::select( 'category_3_id', $categories, isset( $article->category_3_id ) ? $article->category_3_id : 0 ) !!}
</div>

@if ( \Auth::user()->role == 'admin')
	<div class="form-element">
		{!! Form::Label( 'category_4_id', 'Category 4' ) !!} 
		{!! Form::select( 'category_4_id', $categories, isset( $article->category_4_id ) ? $article->category_4_id : 0 ) !!}
	</div>
	<div class="form-element">
		{!! Form::Label( 'category_5_id', 'Category 5' ) !!} 
		{!! Form::select( 'category_5_id', $categories, isset( $article->category_5_id ) ? $article->category_5_id : 0 ) !!}
	</div>
@else
	<?php $formCategory = \App\Category::orderBy( 'id' )->pluck( 'title', 'id' ); ?>
	<div class='form-element'>
		<div>Category 4: {{ isset( $article->category_4_id ) ? $formCategory[ $article->category_4_id ] : 'None' }}</div>
		<div>Category 5: {{ isset( $article->category_5_id ) ? $formCategory[ $article->category_5_id ] : 'None' }}</div>
	</div>
@endif	

<div class="form-element">
  {!! Form::label( 'keywords', 'Keywords' ) !!} 
  {!! Form::text( 'keywords', null, [ 'maxlength' => '100' ] ) !!}
  <p>Keywords limited to 100 charatcters total.</p>
</div>

<div class="form-element">
  {!! Form::label( 'contact_us_url', 'Contact Us URL' ) !!} 
  {!! Form::text( 'contact_us_url', \App\Company::where('id', $id)->first()->contact_us_url,[ 'id'=>'url' ]) !!}
</div>

<div class="form-element">
  {!! Form::label( 'body', 'Description' ) !!} 
  {!! Form::textarea( 'body' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'meta_description', 'Meta Description (SEO - 158 character max)' ) !!} 
  {!! Form::text( 'meta_description' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'image', 'Image' ) !!}
  @if ( !empty( $article->image ))
  	@if ( !empty( $article->video_id ))
      <img src="https://img.youtube.com/vi/<?php echo $article->video_id ?>/hqdefault.jpg" />
      <p>Current Image : https://img.youtube.com/vi/<?php echo $article->video_id ?>/hqdefault.jpg</p>
      {!! Form::file('image', null) !!}
		@else
      <img src="/data/articles/img/{{ $article->image }}?ut={{ str_replace( ' ', '-', $article->updated_at ) }}">
      <p>Current Image : {!! isset( $article->image ) ? $article->image : 'None' !!}</p>
      {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Image? {!! Form::file('image', null) !!}
  	@endif
	@else
   	@if ( !empty( $article->video_id ))
      <img src="https://img.youtube.com/vi/<?php echo $article->video_id ?>/hqdefault.jpg" />
      <p>Current Image : https://img.youtube.com/vi/<?php echo $article->video_id ?>/hqdefault.jpg</p>
      {!! Form::file('image', null) !!}
  	@endif
    {!! Form::file('image', null) !!}
  @endif
</div>

<?php $selectImageWidth = [ 'Default'=>0, '15'=>15, '25'=>25, '30'=>30, '35'=>35, '40'=>40, '50'=>50, '60'=>60, '100'=>100 ]; ?>
<div class="form-element">
  {!! Form::Label( 'image_width', 'Image Width (%)' ) !!} 
  {!! Form::select( 'image_width', $selectImageWidth, isset( $article->image_width) ? $article->image_width : 0 ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'image_caption', 'Image Caption' ) !!} 
  {!! Form::text( 'image_caption' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'general_caption', 'General Caption' ) !!} 
  {!! Form::textarea( 'general_caption' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'video', 'Video' ) !!} 
  {!! Form::textarea( 'video' ) !!}
</div>

@if ( empty( $article->video_id ))
  <div class="form-element article-thumb">
    {!! Form::label( 'video_thumbnail', 'Video Thumbnail' ) !!} 
    {!! form::checkbox( 'video_thumbnail', 'video_thumbnail', false) !!} <label for="video_thumbnail" class="thumb-label">Use Video Thumbnail From the Above Video as Top Left Image?</label> 
  </div>
@endif

<div class="form-element article-video-id">
<!--  {!! Form::label( 'video_id', 'YouTube Video ID' ),"<span class='video-create'>(* required)</span>" !!}  -->
  {!! Form::label( 'video_id', 'YouTube Video ID' ) !!}
  {!! Form::text( 'video_id' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'css', 'Custom Page CSS' ) !!} 
  {!! Form::textarea( 'css' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'css_blocks', 'Custom Block CSS' ) !!} 
  {!! Form::textarea( 'css_blocks' ) !!}
</div>

<?php $publishStatuses = \App\PublishStatus::orderBy( 'id' )->get(); ?>
<div class="form-element">
  {!! Form::Label( 'publish_status_id', 'Publish Status (User)' ) !!} 
  {!! Form::select( 'publish_status_id', $publishStatuses->pluck( 'title', 'id' ), isset( $article->publish_status_id ) ? $article->publish_status_id : '' ) !!}
  <!--
	<ul>
    @foreach ( $publishStatuses AS $publishStatus )
      <li>{{ $publishStatus->title }}: {{ $publishStatus->description }}</li>
    @endforeach
  </ul>
-->
</div>

<div class="form-actions">
  {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
</div>

<style>
.thumb-label {
  display: inline-block;
  font-weight: normal;
}
</style>
<script>
	$('#company').on('change', function(e){
			console.log(e);
			var id = e.target.value;
			$.get('{{ url('articles') }}/api/ajax-state?id=' + id, function(data) {
				$('#url').val(data.contact_us_url);
			});
	});
</script>
