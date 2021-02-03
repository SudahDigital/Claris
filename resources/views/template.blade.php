<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Claris</title>

    <link rel="icon" href="{{ asset('assets/image/logo_claris.png')}}" type="image/png" sizes="16x30">
    <!-- Bootstrap CSS CDN -->
    <link href="//db.onlinewebfonts.com/c/3dd6e9888191722420f62dd54664bc94?family=Myriad+Pro" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <style type="text/css">
        .hidden {
            margin-top: 0px;
            height: 0px;
            -webkit-transition: height 0.5s linear;
               -moz-transition: height 0.5s linear;
                -ms-transition: height 0.5s linear;
                 -o-transition: height 0.5s linear;
                    transition: height 0.5s linear;
        }

        .hidden.open {
             height: 500px;
             -webkit-transition: height 0.5s linear;
                -moz-transition: height 0.5s linear;
                 -ms-transition: height 0.5s linear;
                  -o-transition: height 0.5s linear;
                     transition: height 0.5s linear;
        }
        .scroll { 
                /*height: 500px; */
                overflow-x: hidden; 
                overflow-y: auto; 
                text-align:justify; 
            } 
        .proses_to_chart_slide{
            position:fixed;
            bottom: 10px;
            padding: 10px;
            display: none;
        }

        #my-welcome-message {
            display: none;
            z-index: 9998;
            position: fixed;
            border-radius: 10px;
            width: 42%;
            left: 29%;
            top: 5%;
            padding: 0;
            background: #FDD8AF;
            box-shadow: 5px 10px 18px #0000;
        }

        .preloader{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            opacity : 0.9;
        }

        .preloader .loading {
            position: absolute;
            left: 53%;
            top: 50%;
            transform: translate(-50%,-50%);
            font: 14px arial;
        }

        @media screen and (max-width: 600px) {
            .nav-center {
                position: absolute;
                left: 40%;
            }

            #my-welcome-message {
                width: 42%;
                left: 29%;
                top: 5%;
            }
        }
        @media screen and (min-width: 768px) {
            .nav-center {
                position: absolute;
                left: 45%;
            }

            #my-welcome-message {
                width: 42%;
                left: 29%;
                top: 5%;
            }
        }

        @media screen and (min-width: 1920px) {
            .nav-center {
                position: absolute;
                left: 50%;
            }

            #my-welcome-message {
                width: 42%;
                left: 29%;
                top: 5%;
            }
        }
    </style>

</head>
<body>
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif

    <div class="preloader" id="preloader">
        <div class="loading">
          <img src="{{ asset('assets/image/loader.jpg') }}" width="80" alt="preloader">
          <p style="font-weight:900;line-height:2;color:#174C7C;margin-left: -10%;">Please Wait...</p>
        </div>
    </div>

    <div id="my-welcome-message" class="">
        <img src="{{ asset('assets/image/lg-popup-welcome.jpg') }}" class="d-none d-md-block d-md-none w-100" alt="popup-cara-belanja-lg-web-demo" style="">
        <img src="{{ asset('assets/image/popup-welcome.jpg') }}" class="d-md-none w-100 h-100" alt="popup-cara-belanja-web-demo" style="">
    </div>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
           
            <div class="sidebar-header mx-auto">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/image/logo_claris.png') }}" width="120px" height="70px" class="d-inline-block align-top" alt="" loading="lazy" style="margin: auto !important">
                </a>
            </div>
            <ul class="list-unstyled components">
                <!-- <form class="d-md-none d-block px-3" action="{{route('product_search')}}">
                    <div class="input-group mb-4">
                        <input class="form-control text-center" type="search" name="keyword" placeholder="Search" aria-label="Search" aria-describedby="button-addon">
                    </div>
                </form> -->
                <li class="active">
                    <a href="{{ url('/') }}" style="border-bottom: 3px solid white;">Beranda</a>
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
                    <a href="{{URL::route('contact')}}">Kontak Kami</a>
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

             <div class="row text-center">
                <div class="col-12 my-auto mx-auto">
                    <a href="https://www.facebook.com/" class="mr-1 mr-md-3">
                        <img src="{{ asset('assets/image/icon_facebook.png') }}" alt="" class="img-fluid" style="width: 10px;">
                    </a>
                    <a href="https://www.instagram.com/" class="mr-1 mr-md-3">
                        <img src="{{ asset('assets/image/icon_instagram.png') }}" alt="" class="img-fluid" style="width: 20px;">
                    </a>
                    <a href="https://www.youtube.com/" class="mr-1 mr-md-3">
                        <img src="{{ asset('assets/image/icon_youtube.png') }}" alt="" class="img-fluid" style="width: 20px;">
                    </a>
                    <a href="https://twitter.com/" class="mr-1 mr-md-3">
                        <img src="{{ asset('assets/image/icon_twitter.png') }}" alt="" class="img-fluid" style="width: 20px;">
                    </a>
                </div>
            </div>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 1.5;">
                <div class="container-fluid">
                    <div class="col-4 my-auto">
                        <button type="button" id="sidebarCollapse" class="btn btn-primary button-burger-menu btn-lg">
                            <i class="fas fa-align-justify fa-lg"></i>
                        </button>
                    </div>
                    <div class="col-4 my-auto text-center">
                        <a class="navbar-brand ml-md-5 mx-auto" href="/" style="margin: auto !important">
                            <img src="{{ asset('assets/image/logo_claris.png') }}" width="120px" height="70px" class="p-0 m-0 d-inline-block align-top" alt="" loading="lazy">
                        </a>
                    </div>
                    <div class="col-4 my-auto">
                        <div class="col-8 float-right">
                            <form action="{{route('product_search')}}"  class="form-inline my-2 my-lg-0 ml-auto d-none d-md-inline-block">
                                <div class="input-group">
                                    <button class="btn search_botton_navbar" type="submit" id="button-search-addon"><i class="fa fa-search"></i></button>
                                    <input class="form-control search_input_navbar text-center" name="keyword" type="text" placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                                </div>
                            </form>
                            <a href="#searh_responsive" class="btn btn-info d-md-none" data-toggle="modal" data-target="#searchModal" style="border-radius: 50px; background:#41B1CD; border:none;"><i class="fa fa-search" style=""></i></a>
                        </div>
                    </div>
                </div>
            </nav>
             <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 1;">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-success button-burger-menu">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <a class="navbar-brand nav-center" href="{{ url('/') }}">
                        <img src="{{ asset('assets/image/babystardaz.jpg') }}" width="120px" height="120px" class="p-0 m-0 d-inline-block align-top" alt="" loading="lazy">
                    </a>
                    <form action="{{route('product_search')}}" class="form-inline my-2 my-lg-0 ml-auto d-none d-md-inline-block">
                        <div class="input-group">
                            <input class="form-control d-inline-block m-100 search_input_navbar" name="keyword" type="text" placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                        </div>
                    </form>
                </div>
            </nav> -->


            @isset($page)
                @if($page == 'home') {
                    <!-- BANNER -->
                    <br><br><br>
                    <div role="main" style="margin-top: -4px;">
                        <div id="bannerSlide" class="carousel slide" data-ride="carousel" >
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <li data-target="#bannerSlide" data-slide-to="0" class="active"></li>
                                <!-- <li data-target="#bannerSlide" data-slide-to="1"></li>
                                <li data-target="#bannerSlide" data-slide-to="2"></li> -->
                            </ul>
                            
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/image/banner01.jpg') }}" class="w-100 h-100">
                                </div>
                                <!-- <div class="carousel-item">
                                    <img src="{{ asset('assets/image/logo_claris.png') }}" class="w-100 h-100">
                                </div> -->
                                <!-- <div class="carousel-item">
                                    <img src="{{ asset('assets/image/banner-3.jpg') }}" class="w-100">
                                </div> -->
                            </div>
                            
                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#bannerSlide" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#bannerSlide" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>    
                @endif
            @endisset
            
            <!-- Page Content  -->
            @yield('content')

            <footer class="fixed-bottom"> <!--fixed-bottom-->
                <div id="footer"> <!--class="fixed-bottom"-->
                    <div class="row" style="background-color: #EA7D08; border-radius: 10px; padding: 10px;">
                        <div class="col-5 my-auto align-self-center" id="cart_icon">
                            <?php
                                if(!empty($cart)) {
                                    $total = 0;
                                    foreach($cart as $key => $value) {
                                        $amount = $value->product_harga * $value->mount;
                                        $total += $amount;
                                    }
                                
                            ?>
                                <a href="#" class="float-left cart" style="position: relative;">
                                    <img src="{{ asset('assets/image/troli.png') }}" alt="" style="width: 20px;">
                                    <span style="color: #fff;" class="teks-footer"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></span>
                                </a>
                                   
                            <?php
                                } else {
                            ?>
                                <p class="float-left p-0 my-auto" style="color: #fff;"><strong>Rp 0</strong></p>
                                <a href="{{route('cart')}}" style="position: relative;">
                                    <img src="{{ asset('assets/image/troli.png') }}" alt="" style="width: 30px;">
                                </a>
                            <?php
                                }
                            ?>
                        </div>
                        <div id="tombol_click" class="col-2 my-auto align-self-center">
                            <a href="#" id="clickme" isi="true" style="color: #fff !important">
                                <i class="fas fa-chevron-up fa-lg"></i>
                            </a>
                        </div>
                        <div class="col-5 my-auto align-self-center" id="sosmed">
                            <span style="color: #fff;" class="teks-footer"><strong class="float-right">( {{$count_cart}} Item )</strong></span>
                        </div>
                    </div>
                    <div class="hidden row" id="book" style="background-color: #fff; max-height: 350px;">
                        <div class="scroll w-100 h-100" id="table_c" style="display: none;">
                            @php
                             $total = 0 ;
                            @endphp
                            @foreach($cart as $key => $value)
                            @php
                            $amount = $value->product_harga * $value->mount;
                            $total += $amount;
                            @endphp
                            <div class="row mb-3" style="margin-bottom: 40px;">
                                <div class="col-4">
                                    <div class="text-center">
                                        <img class="img-thumbnail img-fluid" src="{{ asset('assets/image/product/'.(($value->image_link!='') ? $value->image_link : 'none.jpg').'') }}" style="max-width: 90px;max-height: 90px;" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="float-left">
                                        <div class="px-1 py-0">
                                            <p class="product-price-header2 m-0" style="color: #000 !important;"><strong>{{$value->product_name}}</strong></p>
                                        </div>
                                        <div class="px-1 py-0">
                                            <p class="label-harga2 m-0" id="mount2_{{$value->id}}" style="color: #41B1CD !important; font-weight: bold;"><strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong></p>
                                        </div>
                                        <div class="text-left">
                                            <button type="button" class="btn btn-primary button_minus" onclick="cart('{{$value->id}}','min')" style="padding: 0; text-align: center; border: none; background-color: #fff; color: #000; border-radius: 50px;"><i class="fa fa-minus"></i></button>
                                            <span class="product-name mr-1 ml-1" id="show_m2{{$value->id}}" style="color: #000; padding: 3px; font-weight: bold;"> {{$value->mount}} </span>
                                            <button type="button" class="btn btn-primary button_plus" onclick="cart('{{$value->id}}','plus')" style="padding: 0; text-align: center; border: none; background-color: #fff; color: #000; border-radius: 50px;"><i class="fa fa-plus"></i></button>
                                            <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                                            <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                                            <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 align-self-center">
                                    <button class="btn btn-sm btn-danger" onclick="valDel('{{$value->id}}')" style="border-radius: 10px;"><i class="fa fa-times" style="color: white;"></i></button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="listcart" class="col-12 my-auto text-right" style="background-color: #fff; height: 50px; display: none;">
                        <!-- {{ $count_cart }} Item | <span id="total_">Rp {{ number_format($total, 0, ',', '.') }}</span> -->
                        <!-- <div class="col-6"> -->
                            <a href="{{route('cart')}}" class="btn btn-sm btn-primary align-self-right button_pesan" style="background-color: #41B1CD; color: #fff">
                            <input type="hidden" id="total" value="{{$total}}">
                            Beli Sekarang
                            </a>  
                        <!-- </div>   -->
                    </div>
                </div>
                <div id="bottom-footer text-center" style="background-color: #41B1CD;">
                    <div class="text-center py-1">
                        <img src="{{ asset('assets/image/logo_claris_white.png') }}" width="50px" height="30px">
                    </div>
                    <div class="row text-center">
                        <div class="col-12 my-auto mx-auto">
                            <a href="https://www.facebook.com/" class="mr-1 mr-md-3">
                                <img src="{{ asset('assets/image/icon_facebook.png') }}" alt="" class="img-fluid" style="width: 7px;">
                            </a>
                            <a href="https://www.instagram.com/" class="mr-1 mr-md-3">
                                <img src="{{ asset('assets/image/icon_instagram.png') }}" alt="" class="img-fluid" style="width: 15px;">
                            </a>
                            <a href="https://www.youtube.com/" class="mr-1 mr-md-3">
                                <img src="{{ asset('assets/image/icon_youtube.png') }}" alt="" class="img-fluid" style="width: 15px;">
                            </a>
                            <a href="https://twitter.com/" class="mr-1 mr-md-3">
                                <img src="{{ asset('assets/image/icon_twitter.png') }}" alt="" class="img-fluid" style="width: 15px;">
                            </a>
                        </div>
                    </div>
                    <div class="text-center">
                        <a style="color: #fff; font-size: 12px;">© Copyright 2020</a>
                    </div>
                </div>
                <!-- <div class="footer-copyright text-center py-3" style="background-color: #000">© 2020 Copyright:
                    <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
                </div> -->
            </footer>
        </div>
    </div>

    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
            <h5 class="fa fa-trash"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="attachment-body-content">
            <form id="edit-form" class="form-horizontal" method="POST" action="">
              <div class="card text-white bg-dark mb-0">
                <div class="card-header">
                  <h2 class="m-0">Edit</h2>
                </div>
                <div class="card-body">
                  <!-- id -->
                  <div class="form-group">
                    <label class="col-form-label" for="modal-input-id">Id (just for reference not meant to be shown to the general public) </label>
                    <input type="text" name="modal-input-id" class="form-control" id="modal-input-id" required>
                  </div>
                  <!-- /id -->
                  <!-- name -->
                  <div class="form-group">
                    <label class="col-form-label" for="modal-input-name">Name</label>
                    <input type="text" name="modal-input-name" class="form-control" id="modal-input-name" required autofocus>
                  </div>
                  <!-- /name -->
                  <!-- description -->
                  <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Email</label>
                    <input type="text" name="modal-input-description" class="form-control" id="modal-input-description" required>
                  </div>
                  <!-- /description -->
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button id="btn-yes" type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="overlay"></div>

    <div class="modal fade" id="searchModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background: #fff">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <form action="{{route('product_search')}}">
                            <div class="input-group">
                                <div class="input-group-append">
                                        <button class="btn search_botton_navbar" type="submit" id="button-search-addon" style="border-radius: 50%;"><i class="fa fa-search"></i></button>
                                        <input class="form-control d-block search_input_navbar" name="keyword" type="text" value="{{Request::get('keyword')}}" placeholder="Search" aria-label="Search" aria-describedby="button-search-addon">
                                </div>
                                    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/js/jquery.firstVisitPopup.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {  
            /*$('#edit-modal').on('show.bs.modal', function() {
                var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
                var row = el.closest(".data-row");

                // get the data
                var id = el.data('item-id');
                var name = row.children(".name").text();
                var description = row.children(".description").text();

                // fill the data in the input fields
                $("#modal-input-id").val(id);
                $("#modal-input-name").val(name);
                $("#modal-input-description").val(description);

            }) */

            $('#btn-yes').on('click', function(){
                var id_modal = $("#modal-input-id").val();
                Swal.fire('Yes!');
            });

            $(function () {
                $('#my-welcome-message').firstVisitPopup({
                    cookieName : 'homepage',
                    showAgainSelector: '#show-message'
                });
            });

            $(".preloader").fadeOut();
        });

        function valDel(id){
            // $('#edit-modal').modal('show');
            Swal.fire({
              title: 'Hapus barang ?',
              text: "Item ini akan di hapus dari keranjangmu",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#4db849',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus',
              cancelButtonText: "Batal"
            }).then((result) => {
              if (result.isConfirmed) {

                $.ajax({
                    type: "GET",
                    url: "{{url('/cart/delete')}}"+'/'+id,
                    data: {id:id},
                    success: function (data) {
                        Swal.fire({
                           title: 'Sukses',
                           text: 'Item ini berhasil di hapus',
                           icon: 'success',
                           showConfirmButton: false,
                           timer: 1500
                       }).then(function(){ 
                        location.reload();
                        });
                    }         
                });
              }
              
            });
        }
       
    </script>


</body>

</html>