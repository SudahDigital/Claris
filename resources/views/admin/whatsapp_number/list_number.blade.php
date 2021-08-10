@extends('admin.master')
@section('title') Area List @endsection
@section('title2') Manage Whatsapp Area @endsection
@section('content')

@if(session('hasil'))
  <div style="display:none;">
    <input id="status_data" name="status_data" type="hidden" value="{{session('hasil')}}">
  </div>
@else
  <div style="display:none;">
    <input id="status_data" name="status_data" type="hidden" value="empty">
  </div>
@endif

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data</h3>

      <div class="card-tools">
        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button> -->
        <a class="btn btn-success btn-sm" href="{{URL::route('form_area_number')}}">
          <i class="fas fa-plus">
          </i>
          Create Area
       </a>
      </div>
    </div>
    <div class="card-body">
      <table id="tablecategory" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
              <tr style="text-align: center;">
                  <th style="width: 10%;">
                      Area Id
                  </th>
                  <th style="width: 30%">
                      Area Name
                  </th>
                  <th style="width: 30%">
                      Whatsapp Area Number
                  </th>
                  <th style="width: 20%;">
                      Action
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach($whatsapp_area as $key => $value)
              @php
                $no = $key + 1;
              @endphp
              <tr>
                  <td class="text-center">
                      <a>
                          {{ $value->id }}
                      </a>
                  </td>
                  <td>
                      <a>
                          {{ $value->area_name }}
                      </a>
                  </td>
                  <td>
                      <a>
                          +{{ $value->area_number }}
                      </a>
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-info btn-sm" href="{{URL::route('form_edit_area_number', ['id'=>$value->id])}}">
                          <i class="fas fa-pencil-alt">
                          </i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="#"  onclick="delArea('{{ $value->id }}');">
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
</section>

<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- <script src="{{ asset('assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/demo.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {

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

    function delArea(id){
        Swal.fire({
          title: 'Hapus Area ?',
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
                url: "{{url('/admin/hapus-area-number')}}"+'/'+id,
                data: {id:id},
                success: function (data) {
                    Swal.fire({
                       title: 'Sukses',
                       text: 'Area berhasil di hapus',
                       icon: 'success'}).then(function(){ 
                    location.reload();
                    });
                }         
            });
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
