<?php
    $company = \App\Company::find($special->id)->first();
?>

{!! Form::model($company, ['method' => 'PATCH', 'route' => ['agency.profile.update', $company->id]]) !!}
    <br/>
    <br/>
    <div class="form-element">
      {!! Form::label( 'title', 'Company' ) !!}
      {!! Form::text( 'title' ) !!}
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
      {!! Form::select( 'category_id', $categories, isset( $company->category_id ) ? $company->category_id : 0 ) !!}
    </div>

    <div class="form-element">
      {!! Form::Label( 'category_2_id', 'Category 2' ) !!} 
      {!! Form::select( 'category_2_id', $categories, isset( $company->category_2_id ) ? $company->category_2_id : 0 ) !!}
    </div>

    <div class="form-element">
      {!! Form::Label( 'category_3_id', 'Category 3' ) !!} 
      {!! Form::select( 'category_3_id', $categories, isset( $company->category_3_id ) ? $company->category_3_id : 0 ) !!}
    </div>

    <div class="form-element">
      {!! Form::label( 'body', 'About Us' ) !!}
      {!! Form::textarea( 'body' ) !!}
    </div>

    <div class="form-element">
      {!! Form::label( 'image', 'Company Logo' ) !!}
      @if ( isset( $company->image ) && strlen( $company->image ) > 0 )
          <div class="company-image"><img src="/data/companies/img/{{ $company->image }}"></div>
      @endif
      <p>Current Image : {!! isset( $company->image ) ? $company->image : 'None' !!}</p>
      {!! form::checkbox( 'image_delete', 'image_delete', false) !!} Delete Document? {!! Form::file('image', null) !!}
    </div>

    <div class="form-element">
      {!! Form::label( 'contact_us_url', 'Company URL' ) !!}
      {!! Form::text( 'contact_us_url' ) !!}
    </div>

    @if ( \Auth::user()->role == 'admin' )
      <div class="form-element">
        {!! Form::label( 'weight', 'Sort Weight (Higher Numbers First)' ) !!}
        {!! Form::number( 'weight', 0 ) !!}
      </div>
      <div class="form-element">
        {!! Form::Label( 'company_type_id', 'Company Type' ) !!} 
        {!! Form::select( 'company_type_id', \App\CompanyType::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $company->company_type_id ) ? $company->company_type_id : 0 ) !!}
      </div>
      <div class="form-element">
        {!! Form::Label( 'status_id', 'Overall Status (Admin)' ) !!} 
        {!! Form::select( 'status_id', \App\Status::orderBy( 'id' )->pluck( 'title', 'id' ), isset( $company->status_id ) ? $company->status_id : '' ) !!}
      </div>
    @endif

    {!! Form::submit( 'Submit', array('class'=>'btn btn-large btn-primary btn-block' )) !!}
{!! Form::close() !!}

<style>
	.company-image img {
		max-width: 35%;
	}
</style>
