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
                  <!-- Place here the vue notification element -->
                  <notification :userid="{{ auth()->user()->id }}" :unreads="{{ auth()->user()->unreadNotifications }}"></notification>
              </ul>
          </div>
      </nav>
  </header>