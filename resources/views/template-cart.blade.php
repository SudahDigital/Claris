<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Claris</title>

    <link rel="icon" href="{{ asset('assets/image/logo_claris3.png')}}" type="image/png" sizes="16x16">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body>
     @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif

    <div class="wrapper">
        <!-- Sidebar  -->
       <nav id="sidebar">
           
            <div class="sidebar-header mx-auto">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/image/logo_claris.png') }}" width="120px" height="70px" class="d-inline-block align-top" alt="" loading="lazy">
                </a>
            </div>
            <ul class="list-unstyled components">
                <!-- <form class="d-md-none d-block px-3" action="{{route('product_search')}}">
                    <div class="input-group mb-4">
                        <input class="form-control text-center" type="search" name="keyword" placeholder="Search" aria-label="Search" aria-describedby="button-addon">
                    </div>
                </form> -->
                <li class="active">
                    <a href="{{ url('/') }}">Beranda</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kategori Produk</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        @foreach($category as $key => $value)
                        <li>
                            <a href="{{URL::route('product_category', ['id'=>$value->id, 'category_name'=>$value->category_name] )}}" style="font-size: 1.1em !important;">{{$value->category_name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{URL::route('cara_belanja')}}">Cara Berbelanja</a>
                </li>
                <li>
                    <a href="{{URL::route('contact')}}">Kontak</a>
                </li>
            </ul>

            @if($status_login == '')
                <ul class="list-unstyled user-auth">
                    <li>
                        <a href="{{URL::route('cust_login')}}" class="login">Login</a>
                    </li>
                    <li>
                        <a href="{{route('register')}}" class="register">Register</a>
                    </li>
                </ul>
            @elseif($status_login != '')
                <ul class="list-unstyled user-auth">
                    <li>
                        <a>Wellcome, {{$status_login}}</a>
                    </li>
                    <li>
                        <a href="{{URL::route('cust_logout')}}" class="logout">Logout</a>
                    </li>
                </ul>
            @endif
        </nav>
        <div id="content" class="content-cart" style="background-color: #0097bb; background-image: url('{{ asset('assets/image/UI Web Claris New-26.png') }}'), url('{{ asset('assets/image/UI Web Claris New-27.png') }}');">

           <!--  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 1;">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-success button-burger-menu">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <a class="navbar-brand ml-md-5 mx-auto" href="/">
                        <img src="{{ asset('assets/image/babystardaz01.png') }}" width="120px" height="120px" class="p-0 m-0 d-inline-block align-top" alt="" loading="lazy">
                    </a>
                    <form action="{{route('product_search')}}" class="form-inline my-2 my-lg-0 ml-auto d-none d-md-inline-block">
                        <div class="input-group">
                            <input class="form-control d-inline-block m-100 search_input_navbar" name="keyword" type="text" placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                        </div>
                    </form>
                </div>
            </nav> -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 1;">
                <div class="container-fluid">
                    <!-- <div class="col-4 my-auto">
                        <button type="button" id="sidebarCollapse" class="btn btn-primary button-burger-menu btn-lg">
                            <i class="fas fa-align-justify fa-lg"></i>
                        </button>
                    </div> -->
                    <div class="col-12 my-auto text-center">
                        <a class="navbar-brand ml-md-5 mx-auto" href="/" style="margin: 10px !important;">
                            <img src="{{ asset('assets/image/logo_claris.png') }}" width="120px" height="70px" class="p-0 m-0 d-inline-block align-top" alt="" loading="lazy">
                        </a>
                    </div>
                    <!-- <div class="col-4 my-auto">
                        <div class="col-8 float-right">
                            <form action="{{route('product_search')}}"  class="form-inline my-2 my-lg-0 ml-auto d-none d-md-inline-block">
                                <div class="input-group">
                                    <button class="btn search_botton_navbar" type="submit" id="button-search-addon"><i class="fa fa-search"></i></button>
                                    <input class="form-control search_input_navbar text-center" name="keyword" type="text" placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                                </div>
                            </form>
                        </div>
                    </div> -->
                </div>
            </nav>

            <!-- Page Content  -->
            @yield('content')

            <!-- <footer class="footer fixed-bottom mt-5">
                <div class="row">
                    <div class="col-12 my-auto mx-auto">
                        <a href="" class="mr-1 mr-md-3">
                            <img src="{{ asset('assets/image/whatsapp_logo.png') }}" alt="" class="img-fluid" style="width: 35px;">
                        </a>
                        <a href="https://www.instagram.com/orideli.id/" class="mr-1 mr-md-3">
                            <img src="{{ asset('assets/image/instagram_logo.png') }}" alt="" class="img-fluid" style="width: 35px;">
                        </a>
                        <a href="https://facebook.com/" class="mr-1 mr-md-3">
                            <img src="{{ asset('assets/image/facebook_logo.png') }}" alt="" class="img-fluid" style="width: 35px;">
                        </a>
                    </div>
                </div>
            </footer> -->

        </div>
    </div>

    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.firstVisitPopup.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            $(document).ready(function(){
                $(".button_add_to_cart").click(function(){                  
                  $("#totalBottomFixed").removeClass("d-none");
                  $("#totalBottomFixed").addClass("d-inline-block");
                });
            });
        });

    </script>
</body>

</html>