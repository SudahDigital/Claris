@extends('admin.master')
@section('title') Color List @endsection
@section('title2') Manage Color Product @endsection
@section('content')

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data</h3>

      <div class="card-tools">
        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button> -->
        <a class="btn btn-success btn-sm" href="{{URL::route('form_color')}}">
          <i class="fas fa-plus">
          </i>
          Create Color
       </a>
      </div>
    </div>
    <div class="card-body">
      <table id="tablecategory" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th style="width: 10%; text-align: center;">
                      No
                  </th>
                  <th style="width: 30%">
                      Color ID
                  </th>
                  <th style="width: 20%">
                      Color Name
                  </th>
                  <th style="width: 20%">
                      Color Code
                  </th>
                  <th style="width: 20%; text-align: center;">
                      Action
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach($colors as $key => $value)
              @php
                $no = $key + 1;
              @endphp
              <tr>
                  <td class="text-center">
                      {{ $no }}.
                  </td>
                  <td>
                      <a>
                          {{ $value->color_id }}
                      </a>
                  </td>
                  <td>
                      <a>
                          {{ $value->color_name }}
                      </a>
                  </td>
                  <td align="center">
                      <span style="color: {{$value->color_code}};"><i class="fa fa-circle"></i></span>
                  </td>
                  <td class="project-actions text-center">
                      <a class="btn btn-info btn-sm" href="{{URL::route('form_edit_color', ['id'=>$value->id])}}">
                          <i class="fas fa-pencil-alt">
                          </i>
                      </a>
                      <a class="btn btn-danger btn-sm" href="#"  onclick="delColor('{{ $value->id }}');">
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
      $('#tablecategory').DataTable();
    });

    function delColor(id){
        Swal.fire({
          title: 'Hapus Color ?',
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
                url: "{{url('/admin/hapus-color')}}"+'/'+id,
                data: {id:id},
                success: function (data) {
                    Swal.fire({
                       title: 'Sukses',
                       text: 'Color berhasil di hapus',
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
