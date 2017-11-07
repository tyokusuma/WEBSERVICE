<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel" style="background-color: #fff;">
          <img src="{{ asset ('/logo/logo.png') }}" class="user-panel image" alt="User Image">
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>

        <!-- Dashboard menu -->
        <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>

        <!-- Messages -->
        <li class="active"><a href="{{ route('view-inbox') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Messages</span></a></li>

        <!-- User, Admin, Buyer, Service menu -->
        <li class="treeview">
          <a href="#"><i class="fa fa-list-alt"></i> <span>Admin, User, Buyer, Service </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview"><a href="{{ route('view-admins') }}"><i class="fa fa-users" aria-hidden="true"></i><span>Admin</span></a></li>
            <li class="treeview"><a href="{{ route('view-users') }}"><i class="fa fa-users" aria-hidden="true"></i><span>User</span></a></li>
            <li class="treeview"><a href="{{ route('view-buyers') }}"><i class="fa fa-users" aria-hidden="true"></i><span>Buyer</span></a></li>
            <li class="treeview"><a href="{{ route('view-servicedetails') }}"><i class="fa fa-users" aria-hidden="true"></i><span>Service</span></a></li>
          </ul>
        </li>

        <!-- Admi menu -->
        <!-- <li class="treeview">
          <a href="{{ route('view-admins') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Admin</span></a>
        </li> -->

        <!-- User menu -->
        <!-- <li class="treeview">
          <a href="{{ route('view-users') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>User</span></a>
        </li> -->

        <!-- Buyer menu -->
        <!-- <li class="treeview">
          <a href="{{ route('view-buyers') }}"><i class="fa fa-users"></i> <span>Buyer</span></a>
        </li> -->
        
        <!-- Service detail menu -->
        <!-- <li class="treeview">
          <a href="{{ route('view-servicedetails') }}"><i class="fa fa-taxi"></i> <span>Service</span></a>
        </li> -->

        <!-- Tag menu -->
        <li class="treeview">
          <a href="{{ route('view-tags') }}"><i class="fa fa-tags" aria-hidden="true"></i> <span>Tag for Category</span></a>
        </li>

        <!-- Category menu -->
        <li class="treeview">
          <a href="{{ route('view-categories') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Category</span></a>
        </li>

        <!-- Transaction menu -->
        <li class="treeview">
          <a href="{{ route('view-transactions') }}"><i class="glyphicon glyphicon-duplicate"></i> <span>Transaction</span></a>
        </li>

        <!-- Bank menu -->
        <li class="treeview">
          <a href="{{ route('view-index-bank') }}"><i class="fa fa-money"></i> <span>Bank</span></a>
        </li>

        <!-- Payment menu -->
        <li class="treeview">
          <a href="{{ route('view-index-payments') }}"><i class="fa fa-usd"></i> <span>Payment</span></a>
        </li>

        <!-- Armada menu -->
        <li class="treeview">
          <a href="{{ route('view-armadas') }}"><i class="fa fa-taxi"></i> <span>Armada</span></a>
        </li>

        <!-- Term menu -->
        <li class="treeview">
          <a href="{{ route('view-index-term') }}"><i class="fa fa-tasks"></i> <span>Term</span></a>
        </li>

        <!-- City, Province menu -->
        <li class="treeview">
          <a href="{{ route('view-cities') }}"><i class="fa fa-list-alt"></i> <span>City, Province</span></a>
        </li>

        <!-- Misc menu -->
        <li class="treeview">
          <a href="#"><i class="fa fa-cogs"></i> <span>Miscellaneous</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview"><a href="{{ route('view-ads') }}"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Advertisement</span></a></li>
            <li class="treeview"><a href="{{ route('view-others') }}"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i><span>Setting Invite Friends, and Price</span></a></li>
          </ul>
        </li>

        <!-- Chart menu -->
        <li class="treeview">
          <a href="{{ route('view-create-graphs') }}"><i class="fa fa-line-chart"></i> <span>Statistics</span>
          </a>
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

  