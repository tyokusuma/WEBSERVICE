<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
          <img src="{{ asset ('/logo/logo.png') }}" class="user-panel image" alt="User Image">
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>

        <!-- Dashboard menu -->
        <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>

        <!-- Messages -->
        <li class="active"><a href="{{ route('view-inbox') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Messages</span></a></li>

        <!-- User menu -->
        <li class="treeview">
          <a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview"><a href="{{ route('view-create-users') }}"><i class="fa fa-plus" aria-hidden="true"> <span class="dropdown">Add new user</span></i></a></li>
            <li class="treeview"><a href="{{ route('view-users') }}"><i class="fa fa-eye" aria-hidden="true"><span class="dropdown">View all users data</span></i></a></li>
          </ul>
        </li>

        <!-- Category menu -->
        <li class="treeview">
          <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview"><a href="{{ route('view-create-categories') }}"><i class="fa fa-plus" aria-hidden="true"> <span class="dropdown">Add new category</span></i></a></li>
            <li class="treeview"><a href="{{ route('view-categories') }}"><i class="fa fa-eye" aria-hidden="true"><span class="dropdown">View all categories data</span></i></a></li>
          </ul>
        </li>

        <!-- Favorite menu -->
        <li class="treeview">
          <a href="{{ route('view-favorites') }}"><i class="fa fa-heart" aria-hidden="true"></i> <span>Favorite</span></a>
        </li>

        <!-- Transaction menu -->
        <li class="treeview">
          <a href="{{ route('view-transactions') }}"><i class="glyphicon glyphicon-duplicate"></i> <span>Transaction</span></a>
        </li>

        <!-- Buyer menu -->
        <li class="treeview">
          <a href="{{ route('view-buyers') }}"><i class="fa fa-users"></i> <span>Buyer</span></a>
        </li>

        <!-- Service detail menu -->
        <li class="treeview">
          <a href="#"><i class="fa fa-taxi"></i> <span>Service</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview"><a href="{{ route('view-create-servicedetails') }}"><i class="fa fa-plus" aria-hidden="true"> <span>Add new service detail</span></i></a></li>
            <li class="treeview"><a href="{{ route('view-servicedetails') }}"><i class="fa fa-eye" aria-hidden="true"><span>View all services and details</span></i></a></li>
          </ul>
        </li>

        <!-- Misc menu -->
        <li class="treeview">
          <a href="#"><i class="fa fa-cogs"></i> <span>Miscellaneous</span></a>
        </li>

        <!-- Logout -->
        <li class="active">
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  