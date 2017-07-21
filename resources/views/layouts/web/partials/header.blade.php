  <header class="main-header">
      <a href="index2.html" class="logo">
         <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
          </a>
      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">{{ count(user()->notifications) }}</span>
                  </a>
                  <ul class="dropdown-menu notif">
                      <li class="divider menu"></li>
                      <li><a href="#">User stats</a></li>
                      <li class="divider menu"></li>
                  </ul>
              </li>
          </ul>
      </div>
    </nav>
  </header>