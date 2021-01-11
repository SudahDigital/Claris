@extends('admin.master')
@section('title') Banner List @endsection
@section('title2') Manage Banner @endsection
@section('content')

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data</h3>
      <div class="card-tools">
        <a class="btn btn-success btn-sm" href="{{URL::route('form_banner')}}">
          <i class="fas fa-plus">
          </i>
          Create Banner
       </a>
      </div>
    </div>

    <div class="card-body">
      <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
              <tr class="text-center">
                  <th>
                      No
                  </th>
                  <th >
                      Image
                  </th>
                  <th>
                      Image Name
                  </th>
                  <th>
                    Action
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach($banner as $key => $value)
              @php
                $no = $key + 1;
              @endphp
              <tr>
                  <td class="text-center">
                      {{ $no }}.
                  </td>
                  <td class="text-center">
                      <a>
                          <img class="img-thumbnail img-fluid" src="{{ asset('assets/image/banner/'.(($value->image_banner!='') ? $value->image_banner : 'Banner-web.jpg').'') }}" style="max-width: 100px;max-height: 100px;" class="img-fluid">
                      </a>
                  </td>
                  <td>
                      <a>
                          {{ $value->image_banner }}
                      </a>
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-info btn-sm" href="{{URL::route('form_edit_banner', ['id'=>$value->id])}}">
                          <i class="fas fa-pencil-alt">
                          </i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="#"  onclick="delBanner('{{ $value->id }}');">
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
      $('#dtBasicExample').DataTable({
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

    function delBanner(id){
        Swal.fire({
          title: 'Hapus Banner ?',
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
                url: "{{url('/admin/hapus-banner')}}"+'/'+id,
                data: {id:id},
                success: function (data) {
                    Swal.fire({
                       title: 'Sukses',
                       text: 'Image ini berhasil di hapus',
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