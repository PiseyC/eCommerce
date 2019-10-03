  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('images/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/profile-default.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('manage.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{route('manage.dashboard')}}" class="nav-link {{ Nav::isRoute('manage.dashboard') }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @ability('administration,superadministration', 'create-users')
          <li class="nav-item has-treeview {{ Nav::hasSegment(['users', 'roles','permissions','logActivity'], [2], $activeClass = "menu-open") }}">
            <a href="#" class="nav-link {{ Nav::hasSegment(['users', 'roles','permissions'], [2]) }}">
              <i class="fas fa-users-cog"></i>
              <p>
                Administration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link users {{ Nav::isResource('users') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link role {{ Nav::isResource('roles') }}">
                  <div class="far fa-circle nav-icon"></div>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('permissions.index')}}" class="nav-link permission {{ Nav::isResource('permissions') }}">
                  <div class="far fa-circle nav-icon"></div>
                  <p>Permissions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('manage.showlog')}}" class="nav-link log-activity {{ Nav::isRoute('manage.showlog') }}">
                  <div class="far fa-circle nav-icon"></div>
                  <p>Log Activity Lists</p>
                </a>
              </li>
            </ul>
          </li>
          @endability
          <li class="nav-item has-treeview">
            <a href="{{route('manage.chat')}}" class="nav-link {{ Nav::isRoute('manage.chat') }}">
              <i class="far fa-comments"></i>
              <p>
                Chat
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>