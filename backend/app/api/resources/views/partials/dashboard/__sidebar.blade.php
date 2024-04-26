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

<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4" style="background-color: #344054">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->




      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


          <li class="nav-item">
            <a href="#" class="nav-link active bg-warning" style="color:white!important">
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
            <a href="#" class="nav-link">
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

          <li class="nav-item">
            <a href="#" class="nav-link">
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

         <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="height:40px">
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
