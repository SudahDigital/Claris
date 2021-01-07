@extends('admin.master')
@section('title') Order List @endsection
@section('title2') Manage Order @endsection
@section('content')

<section class="content">
   <form method="post" action="{{route('update_order')}}" enctype="multipart/form-data"> <!-- method="post" action="{{route('cart_pay')}}" -->
    @csrf
    <div class="row section_content mb-5" style="margin-bottom: 30px">
        <div class="col-md-12">
            <div class="card mx-auto cart_card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Detail Order</strong></h3>
                </div>
                <div class="row card-body col-md-12">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="name_cust">Nama Customer</label>
                        <input type="text" name="name_cust" class="form-control" id="name_cust" value="{{ $name_cust }}" disabled="true">
                        <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat_cust">Alamat Customer</label>
                        <textarea name="alamat_cust" class="form-control" id="alamat_cust" disabled="true" cols="100" rows="3">{{ $alamat_cust }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="telepon_cust">Telepon Customer</label>
                        <input class="form-control" name="telepon_cust" id="telepon_cust" value="{{ $telepon_cust }}" disabled="true">
                    </div>
                    <div class="form-group">
                        <label for="email_cust">Email Customer</label>
                        <input type="text" name="email_cust" class="form-control" id="email_cust" value="{{ $email_cust }}" disabled="true">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group">
                        <!-- <label for="order">List Order</label> -->
                        <table id="table_dtlord" class="table table-sm table-vcenter table-bordered" style="width:100%">
                          <thead class="font-size-sm text-center" >
                            <tr>
                              <th colspan="4">List Order</th>
                            </tr>
                            <tr>
                              <th width="50">No</th>
                              <th>Product</th>
                              <th style="width: 10%">Quantity (Pcs)</th>
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
                                <span id="no_{{$key}}"> {{ $no }}.</span> 
                              <td>
                                <input id="product_name_{{$key}}" type="text" value="{{ $value->product_name }}" class="form-control form-control-sm" readonly> 
                              </td>
                              <td>
                                <div class="input-group">
                                  <input id="mount_{{$key}}" type="number" value="{{ $value->mount }}" class="form-control form-control-sm" readonly>
                                </div>
                              </td> 
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <!-- <textarea name="order" class="form-control"  id="order" disabled="true" cols="100" rows="10"> @foreach($data_o as $key => $value) <?php $no = $key+1; echo $no.". ".$value->product_name." (".$value->mount." pcs) \n" ?> @endforeach </textarea> -->
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
      $('#table_dtlord').DataTable({
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

    function tes(){
        alert('jalan');
    }
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
</body>
</html>

@endsection
