@extends('layouts/web/master_admin')
@section('pageTitle', 'New Term')
@section('content-subheader', 'Create new term')
@section('main-content')
<div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-term') }}" method="post" role="form">
	       	{{ csrf_field() }}
	       	
	       	<div class="form-group {{ $errors->has('type_term') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Type Term <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="type_term" class="form-control" placeholder="Type of term" required/>
		           	@if ($errors->has('type_term'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('type_term') }}</strong>
		               	</span>
		           	@endif	        		
	        	</div>		           
			</div>	

	       	<div class="form-group {{ $errors->has('category_content') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">category Content <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
	        		<input type="text" name="category_content" class="form-control" placeholder="Category content" />
		           	@if ($errors->has('category_content'))
		            	<span class="help-block">
		                	<strong>{{ $errors->first('category_content') }}</strong>
		               	</span>
		           	@endif	        	
	        	</div>	          
			</div>

	       	<div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
              	<label class="col-sm-3 control-label">Content <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
              		
		            <textarea id="content" name="content" class="form-control"/></textarea>

		          	@if ($errors->has('content'))
		               	<span class="help-block">
		                   	<strong>{{ $errors->first('content') }}</strong>
		               	</span>
		           	@endif
	           	</div>
	       	</div>

            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-info btn-block custom-btn">
		           Register
		       	</button>
		       	<input type="hidden" name="action" value="register" />
	       	</div>
	   		</form>
	</div>
</div>				    
@include('layouts.web.partials.footer')
@endsection

@section('script')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
   var editor_config = {
    path_absolute : "/",
    selector: "textarea#content",
    // content_css: 'myLayout/css',
    font_formats: 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats',
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection