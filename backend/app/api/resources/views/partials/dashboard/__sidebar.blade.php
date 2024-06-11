<style>
.logout-btn {
    background-color: white !important;
    color: black !important;
    font-weight: bold;
}
.logout-btn:hover {
    background-color: #dc3545 !important;
    color: white !important;
}

.sidebar-footer {
      position: absolute;
      bottom: 0;
      width: 100%;
  }

</style>
@if($loginData['user']['username'] == "it_department" || Route::currentRouteName() == 'kitchen.view')

@elseif($loginData['user']['username'] == "fnb_admin")
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4" style="background-color: #344054">
    <div class="sidebar">
        <a href="#" class="brand-link">
            @if($loginData['user']['username'] == "admin")
            <img src="{{ asset('/dist/img/camaya-logo.png')}}" alt="Camaya Logo">

            @else
            <div class="row">
                <div class="col">
                    <img src="{{ asset('/dist/img/camaya-logo.png')}}" alt="Camaya Logo" width="120">
                </div>
                <div class="col">
                    @if($loginData['user']['username'] != "fnb_admin")
                    <img src="{{ asset($loginData['image']) }}" alt="Outlet Logo" height="90" width="90">
                    @endif
                </div>
            </div>
            @endif

          </a>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if($loginData['user']['username'] == "admin")
          <li class="nav-item">
            <a href="{{ route('outlet') }}" class="nav-link {{ request()->is('account') ? 'active bg-primary' : '' }}" style="color:white!important">
                <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6H6.01M6 18H6.01M4 2H20C21.1046 2 22 2.89543 22 4V8C22 9.10457 21.1046 10 20 10H4C2.89543 10 2 9.10457 2 8V4C2 2.89543 2.89543 2 4 2ZM4 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H4C2.89543 22 2 21.1046 2 20V16C2 14.8954 2.89543 14 4 14Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </i>

              <p>
                Accounts
              </p>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ route('location') }}" class="nav-link {{ request()->is('location') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

              </i>
              <p>
                Location
              </p>
            </a>
          </li> --}}


          @else
          <li class="nav-item">
            <a href="{{ route('resto.view') }}" class="nav-link {{ request()->is('restaurants-view') ? 'active bg-primary' : '' }}" style="color:white!important">
                <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6H6.01M6 18H6.01M4 2H20C21.1046 2 22 2.89543 22 4V8C22 9.10457 21.1046 10 20 10H4C2.89543 10 2 9.10457 2 8V4C2 2.89543 2.89543 2 4 2ZM4 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H4C2.89543 22 2 21.1046 2 20V16C2 14.8954 2.89543 14 4 14Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </i>

              <p>
                Orders
              </p>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ route('menu') }}" class="nav-link {{ request()->is('menu') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 7C12 5.93913 11.5786 4.92172 10.8284 4.17157C10.0783 3.42143 9.06087 3 8 3H2V18H9C9.79565 18 10.5587 18.3161 11.1213 18.8787C11.6839 19.4413 12 20.2044 12 21M12 7V21M12 7C12 5.93913 12.4214 4.92172 13.1716 4.17157C13.9217 3.42143 14.9391 3 16 3H22V18H15C14.2044 18 13.4413 18.3161 12.8787 18.8787C12.3161 19.4413 12 20.2044 12 21" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

              </i>
              <p>
                Menu
              </p>
            </a>
          </li> --}}

          {{-- <li class="nav-item">
            <a href="{{ route('kitchen.view') }}" class="nav-link {{ request()->is('kitchen-view') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                <i class="fa-solid fa-kitchen-set"></i>

              </i>
              <p>
                Kitchen
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="{{ route('order-report') }}" class="nav-link {{ request()->is('order-report') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 20V10M12 20V4M6 20V14" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </i>
              <p>
                Reports
              </p>
            </a>
          </li>

          @endif

          <li class="nav-item">
            <a href="{{ route('log') }}"  class="nav-link  {{ request()->is('activity-log') ? 'active bg-primary' : '' }}" style="color:white!important">
              <i class="nav-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 6V12L16 14M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </i>
              <p>
                Activity Logs
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-footer">
       <div class="nav-link">
        <hr style=" border-top: .5px solid white">
         <span class="brand-link">

         <img src="../../dist/img/Camaya.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="height:40px">
        <div style="display: flex; flex-direction: column; justify-content: start;">
            <span style="font-size:14px">{{ $loginData['user']['first_name'] }} {{ $loginData['user']['last_name'] }}</span>
            <span style="font-size:14px; font-weight:bold">{{ $loginData['user']['username'] }}</span>
            </div>
        </span>


            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn active logout-btn" style="width: 100%">Logout</button>
            </form>
       </div>
    </div>

    <!-- /.sidebar-custom -->
</aside>

@else
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4" style="background-color: #344054">
    <div class="sidebar">
        <a href="#" class="brand-link">
            @if($loginData['user']['username'] == "admin")
            <img src="{{ asset('/dist/img/camaya-logo.png')}}" alt="Camaya Logo">

            @else
            <div class="row">
                <div class="col">
                    <img src="{{ asset('/dist/img/camaya-logo.png')}}" alt="Camaya Logo" width="120">
                </div>
                <div class="col">
                    <img src="{{ asset($loginData['image']) }}" alt="Outlet Logo" height="90" width="90">
                </div>
            </div>
            @endif

          </a>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if($loginData['user']['username'] == "admin")
          <li class="nav-item">
            <a href="{{ route('outlet') }}" class="nav-link {{ request()->is('account') ? 'active bg-primary' : '' }}" style="color:white!important">
                <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6H6.01M6 18H6.01M4 2H20C21.1046 2 22 2.89543 22 4V8C22 9.10457 21.1046 10 20 10H4C2.89543 10 2 9.10457 2 8V4C2 2.89543 2.89543 2 4 2ZM4 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H4C2.89543 22 2 21.1046 2 20V16C2 14.8954 2.89543 14 4 14Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </i>

              <p>
                Accounts
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('location') }}" class="nav-link {{ request()->is('location') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

              </i>
              <p>
                Location
              </p>
            </a>
          </li>


          @else
          <li class="nav-item">
            <a href="{{ route('resto.view') }}" class="nav-link {{ request()->is('restaurants-view') ? 'active bg-primary' : '' }}" style="color:white!important">
                <i class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6H6.01M6 18H6.01M4 2H20C21.1046 2 22 2.89543 22 4V8C22 9.10457 21.1046 10 20 10H4C2.89543 10 2 9.10457 2 8V4C2 2.89543 2.89543 2 4 2ZM4 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H4C2.89543 22 2 21.1046 2 20V16C2 14.8954 2.89543 14 4 14Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </i>

              <p>
                Orders
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('menu') }}" class="nav-link {{ request()->is('menu') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 7C12 5.93913 11.5786 4.92172 10.8284 4.17157C10.0783 3.42143 9.06087 3 8 3H2V18H9C9.79565 18 10.5587 18.3161 11.1213 18.8787C11.6839 19.4413 12 20.2044 12 21M12 7V21M12 7C12 5.93913 12.4214 4.92172 13.1716 4.17157C13.9217 3.42143 14.9391 3 16 3H22V18H15C14.2044 18 13.4413 18.3161 12.8787 18.8787C12.3161 19.4413 12 20.2044 12 21" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

              </i>
              <p>
                Menu
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('kitchen.view') }}" class="nav-link {{ request()->is('kitchen-view') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                <i class="fa-solid fa-kitchen-set"></i>

              </i>
              <p>
                Kitchen
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('order-report') }}" class="nav-link {{ request()->is('order-report') ? 'active bg-primary text-white' : '' }}" style="color:white!important">
              <i class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 20V10M12 20V4M6 20V14" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </i>
              <p>
                Reports
              </p>
            </a>
          </li>

          @endif

          <li class="nav-item">
            <a href="{{ route('log') }}"  class="nav-link  {{ request()->is('activity-log') ? 'active bg-primary' : '' }}" style="color:white!important">
              <i class="nav-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 6V12L16 14M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#F2F4F7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </i>
              <p>
                Activity Logs
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-footer">
       <div class="nav-link">
        <hr style=" border-top: .5px solid white">
         <span class="brand-link">

         <img src="../../dist/img/Camaya.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="height:40px">
        <div style="display: flex; flex-direction: column; justify-content: start;">
            <span style="font-size:14px">{{ $loginData['user']['first_name'] }} {{ $loginData['user']['last_name'] }}</span>
            <span style="font-size:14px; font-weight:bold">{{ $loginData['user']['username'] }}</span>
            </div>
        </span>


            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn active logout-btn" style="width: 100%">Logout</button>
            </form>
       </div>
    </div>

    <!-- /.sidebar-custom -->
</aside>
@endif
