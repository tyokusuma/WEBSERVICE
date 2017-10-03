@extends('layouts/web/master_admin')
@section('pageTitle', 'New Term')
@section('content-subheader')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
    {!! $term->content  !!}
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')

@endsection