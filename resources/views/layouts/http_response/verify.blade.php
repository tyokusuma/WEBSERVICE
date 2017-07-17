@extends('layouts/http_response/master_error')
@section('responseTitle', 'Verify Account')
@section('response_content')
    <div class="success">
        <div class="success-code m-b-10 m-t-20">200</div>
            <h3 class="bolding">Success</h3>
            <div class="success-desc">
                The account has been verified succesfully
            <div>
                <a class="login-detail-panel-button btn" href="{{ route('login') }}">
                        Go back to Homepage                        
                </a>
            </div>
        </div>
    </div>
@endsection
