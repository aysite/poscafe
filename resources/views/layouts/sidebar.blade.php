<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Akatsuki</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              @if(@Auth::user()->foto)
                <img src="{{ asset('uploads/user/'.Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image">
              @else
                <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
              @endif
            </div>
            <div class="info">
                <a href="" class="d-block">{{ @Auth::user()->name }} | {{ Str::ucfirst(@Auth::user()->role) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- End Dashnoard --}}

                {{-- Menu --}}
                <li class="nav-item {{ request()->is(["menu","menu/*","category","kitchen"]) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is(["menu","menu/*","category","kitchen"]) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Menu<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- Add New --}}
                        <li class="nav-item">
                            <a href="{{ route('menu.create') }}" class="nav-link {{ request()->is(["menu/create"]) ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        {{-- End Add New --}}

                        {{-- List --}}
                        <li class="nav-item">
                            <a href="{{ route('menu.index') }}" class="nav-link {{ request()->is(["menu"]) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>List</p>
                            </a>
                        </li>
                        {{-- End List --}}

                        {{-- Categories --}}
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{ request()->is(["category"]) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        {{-- End Categories --}}

                        {{-- Kitchens --}}
                        <li class="nav-item">
                          <a href="{{ route('kitchen.index') }}" class="nav-link {{ request()->is(["kitchen"]) ? 'active' : '' }}">
                              <i class="nav-icon far fa-circle"></i>
                              <p>Kitchens</p>
                          </a>
                      </li>
                      {{-- End Kitchens --}}
                    </ul>
                </li>
                {{-- End Menu --}}

                {{-- Table --}}
                <li class="nav-item">
                  <a href="{{ route('table.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-open"></i>
                    <p>Table</p>
                  </a>
                </li>
                {{-- End Table --}}

                {{-- Members --}}
                <li class="nav-item">
                  <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-id-card"></i>
                    <p>Members</p>
                  </a>
                </li>
                {{-- End Members --}}
                
                {{-- Transaction --}}
                <li class="nav-item">
                  <a href="{{ route ('trans.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>Transaction<i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">

                      {{-- Add New --}}
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="fas fa-plus nav-icon"></i>
                              <p>Add New</p>
                          </a>
                      </li>
                      {{-- End Add New --}}

                      {{-- List --}}
                      <li class="nav-item">
                          <a href="{{ route('trans.index') }}" class="nav-link">
                              <i class="nav-icon far fa-circle"></i>
                              <p>List</p>
                          </a>
                      </li>
                      {{-- End List --}}
                  </ul>
              </li>
              {{-- End Transaction --}}

              {{-- Users --}}
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Users</p>
                </a>
              </li>
              {{-- End Users --}}

              {{-- Report --}}
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-print"></i>
                  <p>Report</p>
                </a>
              </li>
              {{-- End Report --}}

              {{-- Settings --}}
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>Settings</p>
                </a>
              </li>
              {{-- End Setings --}}

              {{-- Logout --}}
              <li class="nav-item">
                <a href="{{ route('auth.logout') }}" class="nav-link text-danger">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Logout</p>
                </a>
              </li>
              {{-- End Logout --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
