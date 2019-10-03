  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>-->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      <!-- message notification -->
      <message-notice :user="{{ auth()->user() }}"></message-notice>

      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ Auth::user()->name }}  <i class="fa fa-caret-down"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right p-0">
          <a class="dropdown-item" href="{{ route('manage.profile') }}"><i class="fa fa-fw fa-user-circle" aria-hidden="true"></i> 
            User Profile
          </a>
        <div class="dropdown-divider m-0"></div>
          <a class="dropdown-item" href="{{route('manage.dashboard')}}">
              <i class="fa fa-cog fa-fw"></i> Manage
          </a>
        <div class="dropdown-divider m-0"></div>
          <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out-alt"></i> Logout
          </a>
          @include('_includes.forms.logout')
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->