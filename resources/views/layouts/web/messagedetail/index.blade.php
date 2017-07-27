@extends('layouts/web/master_admin')
@section('pageTitle', 'View Messages Detail')
@section('content-subheader', 'Message Detail')
@section('main-content')

  <div class="panel ">                
      <div class="panel-body">
          <ul class="chat">
              @foreach($messages as $message)
                  @if($message->sender_id == null) 
                  <li class="left clearfix">
                      <span class="chat-img pull-left">
                          <img src="{{ URL::asset('logo/admin.png') }}" class="img-circle bc" />
                      </span>
                      <div class="chat-body clearfix">
                          <div class="header">
                              <bold class="primary-font">Admin</bold> <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>{{ $message->created_at->diffForHumans() }}</small>
                          </div>
                          <p>{{ $message->content }}</p>
                      </div>
                  </li>
                  @else
                  <li class="right clearfix">
                      <span class="chat-img pull-right">
                          <img src="{{ URL::asset('img/'.$profile_image)}}" alt="User Avatar" class="img-circle" />
                      </span>
                      <div class="chat-body clearfix">
                          <div class="header">
                              <bold class="primary-font">{{ $full_name }}</bold>
                              <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>{{ $message->created_at->diffForHumans() }}</small>
                          </div>
                          <p>{{ $message->content }}</p>
                      </div>
                  </li>

                  @endif
              @endforeach
          </ul>
      </div>
      <div class="panel-footer">
          <form action="{{ route('create-inbox-detail') }}" method="post" role="form">
              {{ csrf_field() }}
              <div class="input-group">
                  <input type="hidden" name="message_id" value="{{ $id }}" />
                  <input type="hidden" name="sender_id" value="0" />
                  <input type="hidden" name="receiver_id" value="{{ $user_id }}" />
                  <input type="hidden" name="read_admin" value="0" />
                  <input type="hidden" name="read_user" value="0" />

                  <input id="btn-input" type="text" name="content" class="form-control input-sm" placeholder="Type your message here..."/>
                  <span class="input-group-btn">
                      <button class="btn-warning btn-sm" id="btn-chat">Send</button>
                      <input type="hidden" name="action" value="register" />
                  </span>
              </div>
          </form>
      </div>
  </div>
  

	@include('layouts.web.partials.footer')
	
@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection