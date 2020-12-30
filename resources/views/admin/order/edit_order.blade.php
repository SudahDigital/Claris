<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets_admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets_admin/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('admin.header_sidebar')
  @include('admin.sidebar')
  @include('admin.menu_sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
       <form method="post" action="{{route('edit_order')}}" enctype="multipart/form-data"> <!-- method="post" action="{{route('cart_pay')}}" -->
        @csrf
        <div class="row section_content mb-5" style="margin-bottom: 30px">
            <div class="col-md-12">
                <div class="card mx-auto cart_card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Edit Order</strong></h3>
                    </div>
                    <div class="row card-body col-md-12">
                      <div class="col-3">
                        <div class="form-group">
                          <label for="name_cust">Nama Customer</label>
                            <input type="text" name="name_cust" class="form-control" id="name_cust" value="{{ $name_cust }}">
                            <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat_cust">Alamat Customer</label>
                            <textarea type="text" name="alamat_cust" class="form-control" id="alamat_cust" cols="10" rows="7">{{ $alamat_cust }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="telepon_cust">Telepon Customer</label>
                            <input type="number" maxlength="12" class="form-control" name="telepon_cust" id="telepon_cust" value="{{ $telepon_cust }}">
                        </div>
                        <div class="form-group">
                            <label for="email_cust">Email Customer</label>
                            <input type="text" name="email_cust" class="form-control" id="email_cust" value="{{ $email_cust }}">
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="order_date" value="{{ $order_date }}">
                        </div>
                      </div>
                      <div class="col-9">
                        <div class="form-group">
                          <table id="table_editord" class="table table-sm table-vcenter table-bordered" style="width:100%">
                              <thead class="font-size-sm text-center" >
                                <tr>
                                  <th colspan="4">List Order</th>
                                </tr>
                                <tr>
                                  <th width="50">No</th>
                                  <th>Product</th>
                                  <th style="width: 10%">Quantity (Pcs)</th>
                                  <!-- <th width="80" class="px-0">
                                    <button type="button" class="btn btn-sm btn-primary py-0" id="plusRow">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                  </th> -->
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($data_o as $key => $value)
                                @php
                                  $no = $key + 1;
                                  $countNo = count($data_o);
                                @endphp
                                <tr>
                                  <td class="text-center">
                                    <span id="no_{{$key}}" name="no_{{$key}}"> {{ $no }}.</span>
                                    <input type="hidden" id="id_detail_{{$key}}" name="id_detail_{{$key}}" value="{{$value->pay_id}}"> 
                                  <td>
                                    <input type="hidden" id="product_id_{{$key}}" name="product_id_{{$key}}" value="{{ $value->product_id }}">
                                    <input id="product_name_{{$key}}" name="product_name_{{$key}}" type="text" value="{{ $value->product_name }}" class="form-control form-control-sm" readonly> 
                                    <!-- <select id="product_name_{{$key}}" name="product_name_{{$key}}" class="form-control form-control-sm">
                                      @foreach($data_p as $key_p => $value_p)
                                        @if($value_p->id == $value->product_id)
                                            <option value="{{$value_p->id}}" selected="">{{$value_p->product_name}}</option>
                                        @else
                                            <option value="{{$value_p->id}}">{{$value_p->product_name}}</option>
                                        @endif
                                      @endforeach
                                    </select> -->
                                  </td>
                                  <td>
                                    <div class="input-group">
                                      <input id="mount_{{$key}}" name="mount_{{$key}}" type="number" value="{{ $value->mount }}" class="form-control form-control-sm">
                                    </div>
                                  </td> 
                                  <!-- <td class="text-center">
                                    <a type="button" class="btn btn-sm btn-danger py-0" id="delRow">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                  </td> -->
                                </tr>
                                @endforeach
                              </tbody>
                          </table>
                        </div>
                        @if($role_user == 'superadmin')
                          <div class="form-group">
                              <div class="col-sm-6">
                                <label>Status Order</label>
                                <select class="form-control" required="true"  name="status"  id="status" >
                                  <option value="SUBMIT" <?php if($status=='SUBMIT') echo "selected"; ?> >SUBMIT</option>
                                  <option value="PROCESS" <?php if($status=='PROCESS') echo "selected"; ?> >PROCESS</option>
                                  <option value="FINISH" <?php if($status=='FINISH') echo "selected"; ?> >FINISH</option>
                                  <option value="CANCEL" <?php if($status=='CANCEL') echo "selected"; ?> >CANCEL</option>
                                </select>
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                    @if($role_user == 'superadmin')
                      <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a type="cancel" class="btn btn-warning" href="{{URL::route('list_order')}}">Cancel</a>
                      </div>
                    @elseif($role_user == 'admin')
                      <div class="card-footer text-right">
                          <!-- <button type="button" name="cancel" value="cancel" class="btn btn-warning" href="{{URL::route('list_order')}}">Back</button> -->
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/demo.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() { 
      $("#plusRow").click( function() {
        var table     = document.getElementById('table_editord');
        var rowCount  = table.rows.length;
        var row       = table.insertRow(rowCount);
        var countNo   = $('#no_order').val();
        var no        = parseInt(countNo)+1;
        $('#no_order').val(countNo);
        
        var element1  = "<tr><td class='text-center'><span id='no_"+countNo+"'>"+no+".</span><td><input id='product_name_"+countNo+"' type='text' value='' class='form-control form-control-sm'></td><td><div class='input-group'><input id='mount_"+countNo+"' type='text' value='' class='form-control form-control-sm'></div></td><td class='text-center'><button type='button' class='btn btn-sm btn-danger py-0' id='delRow_"+countNo+"'><i class='fa fa-times-circle'></i></button></td></tr>";
        row.innerHTML = element1; 
      });

      $('#delRow_2').click( function() {  
        var table = document.getElementById('table_editord');
        var rowCount = table.rows.length;
        console.log(rowCount);
        if(rowCount != 1) {   
         rowCount = rowCount - 1;
         table.deleteRow(rowCount);

         alert('jalan');
        }   
      });

      $('#table_editord').DataTable({
        scrollY:        180,
        scrollX:        false,
        scrollCollapse: true,
        paging:         false,
        searching : false,
        "bInfo": false
      });
    });

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $("#upl_image").on('change', function(){
        $("#old_image").html('');
    });
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
</body>
</html>
