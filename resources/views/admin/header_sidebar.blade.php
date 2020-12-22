
  <nav class="main-header navbar navbar-expand navbar-light" style="background-color: #A1C4D8; position: fixed; width: 178vh;">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul> -->
      <span class="brand-text font-weight-light"><strong>Admin Dashboard</strong></span>
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a href="{{URL::route('logout')}}" class="dropdown-item">
                <i class="nav-icon fas fa-sign-out-alt"> Logout</i>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>