  <header class="main-header">
      <a href="index2.html" class="logo">
         <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu" id="markasread" onclick="markAsReadNotification()">
              <ul class="nav navbar-nav">
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="">
                          <i class="fa fa-5-large fa-bell-o sBell"></i>
                          @if (count($notifs) !== 0)
                              <span class="label label-warning sBadge">{{ count($notifs) }}</span>
                          @endif
                      </a>
                      <ul class="dropdown-menu notif" id="notifs">
                          @if (count($notifs) == 0)
                              <li class="divider menu"></li>
                              <li class="noNotif">No new notifications</li>
                              <li class="divider menu"></li>
                          @elseif(count($notifs) > 8)
                              @foreach($notifs->take(8) as $notif)
                                  <li class="divider menu"></li>
                                  <li><a>{{ $notif->data['message'] }}</a></li>
                                  <li class="divider menu"></li>
                              @endforeach
                              <a class="noNotif" href="{{ route('all-notifications') }}">See All Notifications</a>
                          @else
                              @foreach($notifs as $notif)
                                  <li class="divider menu"></li>
                                  <li><a>{{ $notif->data['message'] }}</a></li>
                                  <li class="divider menu"></li>
                              @endforeach
                          @endif
                      </ul>
                  </li>
              </ul>
          </div>
    </nav>
  </header>