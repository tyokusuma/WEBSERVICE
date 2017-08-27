  <header class="main-header">
      <a href="index2.html" class="logo">
         <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu" id="markasread">
              <ul class="nav navbar-nav">
                  <!-- Place here the vue notification element -->
                  <notification :unreads="{{ json_encode($notifs) }}" :userid="{{ json_encode(auth()->user()->id) }}"></notification>
              </ul>
          </div>
      </nav>
  </header>