@extends('admin.master')
@section('title') Order List @endsection
@section('title2') Manage Order @endsection
@section('content')

<section class="content">
  <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data</h3>
          <div class="card-tools">
            <!-- <a class="btn btn-success btn-sm" href="{{URL::route('form_produk')}}">
              <i class="fas fa-plus"></i> Create Product 
            </a> -->
          </div>
      </div>
      <div class="card-body content px-3 py-4">
        <nav class="w-100">
          <div class="nav nav-tabs" id="product-tab" role="tablist">
            <a class="nav-item nav-link {{Request::get('status') == NULL && Request::get('status') == '' || Request::get('status') == 'ALL' ? 'active' : ''}}" href="{{URL::route('list_order', ['status' =>'ALL'])}}" role="tab" style="{{Request::get('status') == NULL && Request::get('status') == '' || Request::get('status') == 'ALL' ? 'background-color: #D2EBD8;' : ''}}">ALL</a>
            <a class="nav-item nav-link {{Request::get('status') == 'SUBMIT' ? 'active' : ''}}" href="{{URL::route('list_order', ['status' =>'SUBMIT'])}}"  role="tab" style="{{Request::get('status') == 'SUBMIT' ? 'background-color: #D2EBD8;' : ''}}">SUBMIT</a> 
            <a class="nav-item nav-link {{Request::get('status') == 'PROCESS' ? 'active' : ''}}" href="{{URL::route('list_order', ['status' =>'PROCESS'])}}"  role="tab" style="{{Request::get('status') == 'PROCESS' ? 'background-color: #D2EBD8;' : ''}}">PROCESS</a>
            <a class="nav-item nav-link {{Request::get('status') == 'FINISH' ? 'active' : ''}}" href="{{URL::route('list_order', ['status' =>'FINISH'])}}"  role="tab" style="{{Request::get('status') == 'FINISH' ? 'background-color: #D2EBD8;' : ''}}">FINISH</a>
            <a class="nav-item nav-link {{Request::get('status') == 'CANCEL' ? 'active' : ''}}" href="{{URL::route('list_order', ['status' =>'CANCEL'])}}"  role="tab" style="{{Request::get('status') == 'CANCEL' ? 'background-color: #D2EBD8;' : ''}}">CANCEL</a>           
          </div>
        </nav>
        <div class="tab-content p-3" id="nav-tabContent">
          <div class="tab-pane fade show active">
            <table id="tableorder" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
              <thead>
                <tr class="text-center">
                  <th>No.</th>
                  <th>Status</th>
                  <th>Customer</th>
                  <th>Order Date</th>
                  <th>Total Quantity</th>
                  <th>Total Price (Rp)</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pay as $key => $value)
                @php
                  $no = $key+1;
                @endphp
                <tr>
                  <td class="text-center">{{$no}}.</td>
                  <td class="text-center">
                    @if( $value->status == 'SUBMIT')
                      <h5><span class="badge bg-danger" style="color: #fff;">SUBMIT</span></h5>
                    @elseif( $value->status == 'PROCESS')
                      <h5><span class="badge bg-info" style="color: #fff;">PROCESS</span></h5>
                    @elseif( $value->status == 'FINISH')
                      <h5><span class="badge bg-success" style="color: #fff;">FINISH</span></h5>
                    @elseif( $value->status == 'CANCEL')
                      <h5><span class="badge bg-secondary" style="color: #fff;">CANCEL</span></h5>
                    @endif
                  </td>
                  <td><small><b>Name :</b> {{ $value->name_cust }}<br>
                      <b>Address :</b> {{ $value->alamat_cust }}<br>
                      <b>Email :</b> {{ $value->email_cust }}<br>
                      <b>Phone :</b> {{ $value->telepon_cust }}<br></small>
                  </td>
                  <td align="center">{{ $value->order_date }}</td>
                  <td align="center">{{ $value->amount }} Pcs</td>
                  <td align="right">{{ number_format($value->total_price) }}</td>
                  <td class="project-actions text-center">
                      <!-- <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-view" onclick="viewDetail('{{ $value->id }}');">
                        <i class="fas fa-eye"></i>
                      </a> -->
                      <a class="btn btn-info btn-sm" href="{{URL::route('detail_order', ['id'=>$value->id])}}">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a class="btn btn-success btn-sm" href="{{URL::route('form_edit_order', ['id'=>$value->id])}}">
                          <i class="fas fa-pencil-alt"></i>
                      </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
</section>

<div class="overlay"></div>

<div class="modal fade" id="modal-view">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #D2EBD8;">
        <i class="fa fa-info-circle"> <strong>Detail Order</strong></i>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row col-sm-12">
          <div class="col-6">
            <strong> Customer</strong><br>
            <td>
                <li><b>Name :</b> <span id="name_cust"></span></li>
                <li><b>Address :</b> <span id="alamat_cust"></span></li>
                <li><b>Email :</b> <span id="email_cust"></span></li>
                <li><b>Phone :</b> <span id="telepon_cust"></span></li>
            </td>
            <hr>
            <strong> Total Price : </strong><br>
            <span id="total_price"></span>
            <hr>
            <strong> Order Date : </strong><br>
            <span id="order_date"></span>
          </div>
          <div class="col-6">
            <strong> Total Order : </strong><br>
            <span id="tot_order"></span>
            <hr>
            <strong> Detail Product : </strong><br>
            <div id="detail_prd"></div>
            <hr>
            <strong> Status Order : </strong><br>
            <span id="status_order"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
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
    $(document).ready(function () {
      $('#tableorder').DataTable({
        scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns: true
      });
    });

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    function viewDetail(id){
      $.ajax({
          type: "GET",
          url: "{{url('/admin/detail-order')}}",
          data: {id:id},
          success: function (data) {
            var name_cust     = data.name_cust;
            var alamat_cust   = data.alamat_cust;
            var email_cust    = data.email_cust;
            var telepon_cust  = data.telepon_cust;

            $('#name_cust').html(name_cust);
            $('#alamat_cust').html(alamat_cust);
            $('#email_cust').html(email_cust);
            $('#telepon_cust').html(telepon_cust);
            $('#total_price').html("Rp. "+data.total_price+" ,-");
            $('#order_date').html(data.order_date);

            for (var i=0; i<data.data_o.length; i++){
              $('#detail_prd').html('<li><span>'+data.data_o[i].product_name+' ('+data.data_o[i].mount+') </span></li>');
            }

            $.each(data.data_o, function(index, value){
                // alert('jalan'+index);
            });

            if(data.status == 'SUBMIT'){
              $('#status_order').html('<span class="badge bg-danger" style="color: #fff;">'+data.status+'</span>');
            }else if(data.status == 'PROCESS'){
              $('#status_order').html('<span class="badge bg-info" style="color: #fff;">'+data.status+'</span>');
            }else if(data.status == 'FINISH'){
              $('#status_order').html('<span class="badge bg-success" style="color: #fff;">'+data.status+'</span>');
            }else if(data.status == 'CANCEL'){
              $('#status_order').html('<span class="badge bg-secondary" style="color: #fff;">'+data.status+'</span>');
            }
          }         
      });
    }

</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
</body>
</html>

@endsection