@extends('admin.master')
@section('title') Voucher List @endsection
@section('title2') Manage Voucher @endsection
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
        <a class="btn btn-success btn-sm" href="{{URL::route('form_voucher')}}">
          <i class="fas fa-plus">
          </i>
           Create Voucher
       </a>
      </div>
    </div>
    <div class="card-body">
      <table id="tablevoucher" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
              <tr class="text-center">
                  <th>
                      No
                  </th>
                  <th>
                      Code Voucher
                  </th>
                  <th>
                      Name
                  </th>
                  <th>
                      Description
                  </th>
                  <th>
                      Total Used
                  </th>
                  <th>
                      Max Usages
                  </th>
                  <th>
                      Type
                  </th>
                  <th>
                      Expired Date
                  </th>
                  <th>
                      Status
                  </th>
                  <th>
                      Action
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach($voucher as $key => $value)
              @php
                $no = $key + 1;
              @endphp
              <tr class="text-center">
                  <td>
                      {{ $no }}.
                  </td>
                  <td>
                      {{ $value->code }}
                  </td>
                  <td>
                      {{ $value->name }}
                  </td>
                  <td>
                      {{ $value->description }}
                  </td>
                  <td>
                    @if($value->uses == '')
                      0
                    @else
                      {{ $value->uses }}
                    @endif
                  </td>
                  <td>
                      {{ $value->max_uses }}
                  </td>
                  <td>
                    @if($value->type == 1)
                      Percentage
                    @elseif($value->type == 2)
                      Flat
                    @endif
                  </td>
                  <td>
                      {{ date("d-F-Y", strtotime($value->expires_at)) }}
                  </td>
                  <td>
                    @php
                      $max_usage = $value->max_uses;
                      $cur_date = date('Y-m-d');
                      $exp_date = date("Y-m-d", strtotime($value->expires_at));
                      if($value->uses >= $max_usage)
                      {
                        echo '<span class="badge bg-yellow text-white">FULL USED</span>';
                      }
                      elseif($cur_date > $exp_date){
                        echo '<span class="badge bg-red text-white">EXPIRED</span>';
                      }
                      else
                      {
                        echo '<span class="badge bg-green text-white">ACTIVE</span>';
                      }
                    @endphp
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-info btn-sm" href="{{URL::route('form_edit_voucher', ['id'=>$value->id])}}">
                          <i class="fas fa-pencil-alt">
                          </i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="#"  onclick="delData('{{ $value->id }}');">
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
      $('#tablevoucher').DataTable({
        scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns: true
      });

      var toastMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        title: 'General Title',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });

      var popup = $('#status_data').val();
      if(popup == 'success'){
        toastMixin.fire({
          animation: true,
          title: 'Successfully saved Voucher'
        });
      }else if(popup == 'failed'){
        toastMixin.fire({
          title: 'Failed saved Voucher!',
          icon: 'error'
        });
      }
    });

    function delData(id){
        Swal.fire({
          title: 'Hapus Voucher ?',
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
                url: "{{url('/admin/hapus-voucher')}}"+'/'+id,
                data: {id:id},
                success: function (data) {
                    Swal.fire({
                       title: 'Sukses',
                       text: 'Voucher berhasil di hapus',
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
