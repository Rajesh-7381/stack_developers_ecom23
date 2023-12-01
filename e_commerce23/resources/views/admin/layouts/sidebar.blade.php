<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  {{-- <a href="{{url('/admin/dashboard')}}" class="brand-link">
    <img src="{{url(''.Auth::guard('admin')->user()->image)}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a> --}}

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        {{-- <img src="{{url(''.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image"
          height="100" width="100"> --}}
      </div>
      <div class="info">
        {{-- <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a> --}}
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'menu-open' : '' }}">
            <a href="{{ url('admin/dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Dashboard</p>
            </a>
            {{-- <a href="{{ url('admin/dashboard') }}" class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>Dashboard</p>
            </a> --}}
        </li>
        {{-- @if (Auth::guard('admin')->user()->type=='admin')
        <li class="nav-item {{ Request::is('admin/updatepassword*') || Request::is('admin/updateadmindetails*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('admin/updatepassword*') || Request::is('admin/updateadmindetails*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Settings
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
          
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ url('admin/updatepassword') }}" class="nav-link {{ Request::is('admin/updatepassword*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Update Admin Password</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ url('admin/updateadmindetails') }}" class="nav-link {{ Request::is('admin/updateadmindetails*') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Update Admin Details</p>
                  </a>
              </li>
          </ul>
            @endif
            
        </li>
    
        <li class="nav-item {{ Request::is('admin/cms-page*') ? 'menu-open' : '' }}">
            <a href="{{ url('admin/cms-page') }}" class="nav-link {{ Request::is('admin/cms-page*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    CMS Pages
                </p>
            </a>
        </li>
        @if (Auth::guard('admin')->user()->type=='admin')
        <li class="nav-item {{ Request::is('admin/sub-admins*') ? 'menu-open' : '' }}">
            <a href="{{ url('admin/sub-admins') }}" class="nav-link {{ Request::is('admin/sub-admins*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  sub-admins
                </p>
            </a>
        </li>
        @endif
        @if (Auth::guard('admin')->user()->type=='admin')
        <li class="nav-item {{ Request::is('admin/categories*') || Request::is('admin/products*') || Request::is('admin/brands*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('admin/categories*') || Request::is('admin/products*') || Request::is('admin/brands*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                catalogues
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
        
          <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ url('admin/categories') }}" class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/brands') }}" class="nav-link {{ Request::is('admin/brands*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Brands</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/products') }}" class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Products</p>
                </a>
            </li>
         </ul>
        </li>
        @endif --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>