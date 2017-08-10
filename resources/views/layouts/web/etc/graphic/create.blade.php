@extends('layouts/web/master_admin')
@section('pageTitle', 'Create Graphic')
@section('content-subheader', 'Create Graphic')
@section('main-content')
    <div class="contentpanel cs_df">
    @include ('flash::message')
	<div class="row">
   			<form action="{{ route('create-graphs') }}" method="get" role="form">
	       	
	       	<div class="form-group">
              	<label class="col-sm-3 control-label">User <span class="asterisk">*</span></label>
              	<div class="col-sm-7 col-sm-offset-1 form-style">
        			<select id="user_id" name="user_id" class="form-control chosen-select mySelect" style="margin-left: 1%; width:70%;" placeholder="Choose a user" required>
	                	@foreach($users as $user)
	                     	<option value="{{ $user->id }}">{{ $user->full_name }} <span>{{ $user->email }}</span></option>
		                @endforeach
                  	</select>
	        	</div>		           
			</div>	

            <div class="form-group">
                <label class="col-sm-3 control-label">Month <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
                  	<select id="month" name="month" class="form-control chosen-select mySelect1" style="margin-left: 1%; width:50%;" placeholder="Choose month" required>
	                	@foreach($months as $keyIndex => $month)
	                     	<option value="{{ $keyIndex + 1 }}">{{ $month }} </option>
		                @endforeach
                  	</select>
                </div>	           	
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Year <span class="asterisk">*</span></label>
                <div class="col-sm-6 col-sm-offset-1 form-style">
                  	<select id="year" name="year" class="form-control chosen-select mySelect2" style="margin-left: 1%; width:50%;" placeholder="Choose year" required>
	                	@foreach($years as $year)
	                     	<option value="{{ $year }}">{{ $year }} </option>
		                @endforeach
                  	</select>
                </div>	           	
            </div>

            <div class="col-sm-6 col-sm-offset-3">
		       	<button class="btn btn-success btn-block custom-btn">
		           Create graphic
		       	</button>
		       	<input type="hidden" name="action" value="register" />
	       	</div>
	   		</form>
	</div>
</div>	
    @include('layouts.web.partials.footer')
@endsection

@section('script')
<script>
	$('.mySelect').select2();
	$('.mySelect1').select2();
	$('.mySelect2').select2();    
</script>
@endsection
