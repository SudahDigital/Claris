@extends('admin.master')
@section('title') User List @endsection
@section('title2') Manage User Admin @endsection
@section('content')

<section class="content">
  @if(session('hasil'))
    <div style="display:none;">
      <input id="status_data" name="status_data" type="hidden" value="{{session('hasil')}}">
    </div>
  @else
    <div style="display:none;">
      <input id="status_data" name="status_data" type="hidden" value="empty">
    </div>
  @endif
   <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data</h3>

      <div class="card-tools">
        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button> -->
        <a class="btn btn-success btn-sm" href="{{URL::route('form_user')}}">
          <i class="fas fa-pencil-alt"></i> Create User
       </a>
      </div>
    </div>
    <div class="card-body">
      <table id="tableuser" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
              <tr class="text-center">
                  <th>
                      User Name
                  </th>
                  <th>
                      Full Name
                  </th>
                  <th>
                      User Email
                  </th>
                  <th>
                      User Status
                  </th>
                  <th>
                    Action
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach($users as $key => $value)
              @php
                $no = 1;
              @endphp
              <tr>
                  <td>
                      {{ $value->name }}
                  </td>
                  <td>
                      {{ $value->full_name }}
                  </td>
                  <td>
                      {{ $value->email }}
                  </td>
                  <td>
                      {{ $value->role }}
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-info btn-sm" href="{{URL::route('form_edit_user', ['id'=>$value->id])}}">
                          <i class="fas fa-pencil-alt">
                          </i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="#"  onclick="delUser('{{ $value->id }}');">
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
      $('#tableuser').DataTable({
          scrollY:        "400px",
          scrollX:        true,
          scrollCollapse: true,
          paging:         false,
          fixedColumns: true
        });
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
        title: 'Successfully save New User'
      });
    }else if(popup == 'failed'){
      toastMixin.fire({
        title: 'Failed saved User',
        icon: 'error'
      });
    }

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    function delUser(id){

        Swal.fire({
          title: 'Hapus User ?',
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
                url: "{{url('/admin/hapus-user')}}"+'/'+id,
                data: {id:id},
                success: function (data) {
                    Swal.fire({
                       title: 'Sukses',
                       text: 'User berhasil di hapus',
                       icon: 'success'}).then(function(){ 
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

@endsection