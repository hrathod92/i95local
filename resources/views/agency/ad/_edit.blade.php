<div class="form-element">
  {!! Form::Label( 'company_id', 'Company' ) !!}

  <?php
    $company_id = isset( $id ) ? $id : 0;
  ?>

  @if ( \Auth::check() && \Auth::user()->role == 'admin' )
    {!! Form::select( 'company_id', \App\Company::whereNotNull('title')->where('title', '!=', '')->orderBy( 'id' )->lists( 'title', 'id' ), $company_id) !!}
  @else
	{!! Form::hidden( 'company_id', $company_id ) !!}
    {!! Form::select( 'company_id', \App\Company::whereId( $company_id )->lists( 'title', 'id' ), $company_id, ["disabled" => "disabled"]) !!}
  @endif
</div>

@if ( \Auth::check() && \Auth::user()->role == 'agency' )
  <div class="form-element">
    {!! Form::Label( 'ad_type_id', 'Ad Position' ) !!} 
    {!! Form::select( 'ad_type_id', \App\AdType::whereBetween('id', [20, 29])->orderBy( 'title' )->lists( 'title', 'id' ), isset( $ad->ad_type_id ) ? $ad->ad_type_id : '' ) !!}
  </div>
@endif

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
  {!! Form::Label( 'category_id', 'Category' ) !!} 
  {!! Form::select( 'category_id', $categories, isset( $ad->category_id ) ? $ad->category_id : 0 ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'title', 'Title' ) !!}
  {!! Form::text( 'title' ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'image', 'Image' ) !!}
  <p>Current Image : {!! isset( $ad->image ) ? $ad->image : 'None' !!}</p>
  {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Document? {!! Form::file('image', null) !!}
</div>

<div class="form-element">
  {!! Form::label( 'ad_url', 'Ad Target URL' ) !!}
  {!! Form::text( 'ad_url' ) !!}
</div>

@if ( \Auth::check() && \Auth::user()->role == 'admin' )
<div class="form-element">
  {!! Form::label( 'random_weight' ) !!}
  {!! Form::text( 'random_weight') !!}
</div>
@endif


<div class="form-element">
  {!! Form::label( 'publish_start_at', 'Publish Start' ) !!}
  {!! Form::date( 'publish_start_at', isset( $ad->publish_start_at ) ? $ad->publish_start_at : \Carbon\Carbon::now() ) !!}
</div>

<div class="form-element">
  {!! Form::label( 'publish_end_at', 'Publish End' ) !!}
  {!! Form::date( 'publish_end_at', isset( $ad->publish_end_at ) ? $ad->publish_end_at : \Carbon\Carbon::now() ) !!}
</div>

<div class="form-element">
  {!! Form::Label( 'publish_status_id', 'Publish Status' ) !!} 
  {!! Form::select( 'publish_status_id', \App\PublishStatus::orderBy( 'id' )->lists( 'title', 'id' ), isset( $ad->publish_status_id ) ? $ad->publish_status_id : 1 ) !!}
</div>

@if ( \Auth::user()->role == 'admin' )
  <div class="form-element">
    {!! Form::Label( 'status_id', 'Status' ) !!} 
    {!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->lists( 'title', 'id' ), isset( $ad->status_id ) ? $ad->status_id : 0 ) !!}
  </div>
@endif

<div class="form-element">
  {!! Form::label( 'body', 'Notes' ) !!}
  {!! Form::textarea( 'body', isset( $ad ) ? $ad->body : null ) !!}
</div>

{!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary' )) !!}
