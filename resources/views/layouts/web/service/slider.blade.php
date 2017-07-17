@extends('layouts/web/master_admin')
@section('pageTitle', 'View Services Detail Images')
@section('content-subheader', 'List Services Detail Images')
@section('main-content')

    <div class="container">
	    <div id="slides">
		    <img src="{{ URL::asset('img/'.$ktp) }}" class="sliderimages"/>
		    <img src="{{ URL::asset('img/'.$sim) }}" class="sliderimages"/>
		    <img src="{{ URL::asset('img/'.$stnk) }}" class="sliderimages"/>
		    <img src="{{ URL::asset('img/'.$vehicle) }}" class="sliderimages"/>
		    <a href="#" class="slidesjs-previous slidesjs-navigation"></a>
		    <a href="#" class="slidesjs-next slidesjs-navigation"></a>
	  	</div>
  	</div>
	

	@include('layouts.web.partials.footer')
	
@endsection

@section('script')
<script type="text/javascript">
	$(function() {
      $('#slides').slidesjs({
        width: 780,
        height: 400,
        navigation: {
          effect: "fade"
        },
        pagination: {
          effect: "fade"
        },
        effect: {
          fade: {
            speed: 400
          }
        }
      });
    });
</script>
@endsection