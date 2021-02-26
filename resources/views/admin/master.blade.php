<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>

  <link rel="icon" href="{{ asset('assets/image/logo_claris3.png')}}" type="image/png" sizes="16x30">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/daterangepicker/daterangepicker.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('admin.header_sidebar')
  @include('admin.sidebar')
  @include('admin.menu_sidebar')

  <div class="content-wrapper" style="padding-top: 50px">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><b>@yield('title')</b></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@yield('title2')</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>

  @include('admin.footer')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/demo.js') }}"></script>
<script type="text/javascript">

</script>
</body>
</html>