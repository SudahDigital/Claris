@extends('admin.master')
@section('title') Product List @endsection
@section('title2') Manage Product @endsection
@section('content')

<div class="card">  
  <div class="card-header">
    <h3 class="card-title">Data</h3>
    <div class="card-tools">
      <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button> -->
        <a class="btn btn-success btn-sm" onclick="DownloadTpl();" style="color: #fff;">
        <i class="fas fa-download"></i>&nbsp;Download Template
      </a>
      <a class="btn btn-success btn-sm" href="{{URL::route('import_produk')}}">
        <i class="fas fa-upload"></i>&nbsp;Upload Product
      </a>
      <a class="btn btn-success btn-sm" href="{{URL::route('form_produk')}}">
        <i class="fas fa-plus"></i>&nbsp;Create Product 
      </a>
    </div>
  </div>

  @if(session('hasil'))
    <div style="display:none;">
      <input id="status_data" name="status_data" type="hidden" value="{{session('hasil')}}">
    </div>
  @else
    <div style="display:none;">
      <input id="status_data" name="status_data" type="hidden" value="empty">
    </div>
  @endif

  <div class="card-body content">
    <nav class="w-100">
      <div class="nav nav-tabs" id="product-tab" role="tablist">
        <a class="nav-item nav-link {{Request::get('status') == NULL && Request::get('status') == '' || Request::get('status') == 'publish' ? 'active' : ''}}" href="{{URL::route('dash_produk', ['status' =>'publish'])}}" role="tab" style="{{Request::get('status') == NULL && Request::get('status') == '' || Request::get('status') == 'publish' ? 'background-color: #D2EBD8;' : ''}}">Publish Product</a>
        <a class="nav-item nav-link {{Request::get('status') == 'draft' ? 'active' : ''}}" href="{{URL::route('dash_produk', ['status' =>'draft'])}}"  role="tab" style="{{Request::get('status') == 'draft' ? 'background-color: #D2EBD8;' : ''}}">Draft Product</a>         
      </div>
    </nav>
    <div class="tab-content p-3" id="nav-tabContent">
      <div class="tab-pane fade show active">
        <table id="tableprod" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <tr>
              <td colspan="9" class="text-center">Product</td>
            </tr>
              <tr>
                  <td>
                      No
                  </td>
                  <td class="text-center">
                      Image
                  </td>
                  <td>
                      Code
                  </td>
                  <td>
                      Name
                  </td>
                  <td>
                      Category
                  </td>
                  <td>
                      Price (Rp)
                  </td>
                  <td>
                      Stock (Pcs)
                  </td>
                  <td>
                      Discount (%)
                  </td>
                  <td style="text-align: center;">
                    Action
                  </td>
              </tr>
          </thead>
          <tbody>
            @foreach($product as $key => $value)
              @php
                $no = $key + 1;
              @endphp
              <tr>
                  <td class="text-center">
                      {{ $no }}.
                  </td>
                  <td class="text-center">
                      <a>
                          <img class="img-thumbnail img-fluid" src="{{ asset('assets/image/product/'.(($value->product_image!='') ? $value->product_image : '20200621_184223_0016.jpg').'') }}" style="max-width: 50px;max-height: 50px;" class="img-fluid">
                      </a>
                  </td>
                  <td>
                      <a>
                          {{ $value->product_code }}
                      </a>
                  </td>
                  <td>
                      <a>
                          {{ $value->product_name }}
                      </a>
                  </td>
                  <td>
                      <a>
                          {{ $value->category_name }}
                      </a>
                  </td>
                  <td style="text-align: right;">
                    @if($value->product_discount > 0)
                      <a><del>{{ number_format($value->product_harga) }}</del></a><br>
                      <a style="color:red;">{{ number_format($value->price_promo) }}</a>
                    @else
                      <a>{{ number_format($value->product_harga) }}</a>
                    @endif  
                  </td>
                  <td style="text-align: center;">
                      <a>
                         {{ $value->product_stock }}
                      </a>
                  </td>
                  <td style="text-align: center;">
                      <a>
                         {{ $value->product_discount }}
                      </a>
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-view" onclick="viewProduct('{{ $value->id }}');">
                          <i class="fas fa-eye">
                          </i>
                      </a>
                      <a class="btn btn-success btn-sm" href="{{URL::route('form_edit_produk', ['id'=>$value->id])}}">
                          <i class="fas fa-pencil-alt">
                          </i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="#"  onclick="delProduct('{{ $value->id }}');">
                          <i class="fas fa-trash">
                          </i>
                      </a>
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>

<div class="modal fade" id="modal-view">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #D2EBD8;">
        <i class="fa fa-info-circle"> <strong>Detail Product</strong></i>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row col-12">
          <div class="col-6">
            <img id="img_prd" width="100%" height="100%" class="img-fluid img-responsive" style="max-width: 400px;max-height: 400px;"> 
          </div>
          <div class="card col-6">
            <div class="card" style="background-color: #D2EBD8;">
              <div class="card-body">
                <strong> Product Name</strong>
                <p id="prodnama"></p>
                <hr>
                <strong> Product Description</strong>
                <p id="proddesc"></p>
                <hr>
                <strong> Category</strong>
                <p id="category"></p>
                <hr>
                <strong> Price</strong>
                <p id="price"></p>
                <hr>
                <strong> Stock (Pcs)</strong>
                <p id="stock"></p>
                <hr>
                <strong> Top Product</strong><br>
                <span id="flag_top"></span>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets_admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- <script src="{{ asset('assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/demo.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#tableprod').DataTable({
          scrollY:        "400px",
          scrollX:        true,
          scrollCollapse: true,
          paging:         false,
          fixedColumns: true
        });

        var hasil = $('#status_data').val();
        if(hasil == 'Success'){
          Swal.fire({
            title: hasil,
            icon: 'success'
          });
        }else if(hasil == 'Failed'){
          Swal.fire({
            title: hasil,
            icon: 'danger'
          });
        }
    });

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    function Execute(){
      var filter_status = $("#filter_status").val();
      if(filter_status!=''){
        $.ajax({
          type: "GET",
          url: "{{url('/admin/exec-produk')}}"+'/'+filter_status,
          data: {par:filter_status},
          success: function (data) {
            $('.wrapper').html(data);
            $('.modal-backdrop').hide();
          }         
        });
      }
    }

    function delProduct(id, par){
        Swal.fire({
          title: 'Hapus Produk ?',
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
                url: "{{url('/admin/hapus-produk')}}"+'/'+id,
                data: {id:id, par: par},
                success: function (data) {
                    Swal.fire({
                       title: 'Sukses',
                       text: 'Item ini berhasil di draft',
                       icon: 'success'}).then(function(){ 
                    location.reload();
                    });
                }         
            });
          }
          
        });
    }

    function viewProduct(id){
      $.ajax({
          type: "GET",
          url: "{{url('/admin/view-produk')}}",
          data: {id:id},
          success: function (data) {
            var foto     = data[0].product_image;
            var prodnama = data[0].product_name;
            var proddesc = data[0].product_description;
            var category = data[0].category_name;
            var price    = data['formatharga'];
            var stock    = data[0].product_stock;
            var flag_top = data['flag_top'];

            $('#img_prd').attr('src','{{ asset("assets/image/product") }}'+'/'+foto);
            $('#prodnama').html(prodnama);
            $('#proddesc').html(proddesc);
            $('#category').html(category);
            $('#price').html(price);
            $('#stock').html(stock);
            $('#flag_top').html(flag_top);
          }         
      });
    }

    function DownloadTpl(){
      $.ajax({
          url: "{{url('/admin/download_tpl_produk')}}",
          type: "GET",
          responseType: "blob"
      })
      .then((response) => {

          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'product.xlsx'); //or any other extension
          document.body.appendChild(link);
          link.click();
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
