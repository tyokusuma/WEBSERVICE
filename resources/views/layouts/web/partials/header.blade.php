  <header class="main-header">
      <a href="index2.html" class="logo">
         <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
          </a>
          <notification :userid="{{ Auth::id() }}" :unreads="{{ Auth::user()->unreadNotifications }}"></notification>
    </nav>
  </header>