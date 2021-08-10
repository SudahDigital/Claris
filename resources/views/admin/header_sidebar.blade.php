
  <nav class="main-header navbar navbar-expand navbar-light" style="background-color: #A1C4D8;">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul> -->
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a href="{{URL::route('view_pass', ['username'=> auth()->user()->name, 'emailuser'=> auth()->user()->email])}}" class="dropdown-item">
                <i class="nav-icon fas fa-cog"></i> Change Password
            </a>
            <a href="{{URL::route('logout')}}" class="dropdown-item">
                <i class="nav-icon fas fa-sign-out-alt"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>