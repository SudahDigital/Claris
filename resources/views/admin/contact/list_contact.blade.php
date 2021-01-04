@include('admin.contact.dash_contact')
  <!-- Main content -->
    <section class="content">
       <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data</h3>

          <div class="card-tools">
            <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button> -->
            <a class="btn btn-success btn-sm" href="{{URL::route('form_edit_kontak')}}">
              <i class="fas fa-pencil-alt">
              </i>
              Edit Contact
           </a>
          </div>
        </div>
        <div class="card-body">
           <table id="tablecontact" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th style="width: 50%">
                          Email
                      </th>
                      <th style="width: 50%">
                          No Telepon
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($contact as $key => $value)
                  @php
                    $no = 1;
                  @endphp
                  <tr>
                      <td>
                          {{ $value->email }}
                      </td>
                      <td>
                          <a>
                              {{ $value->no_telp }}
                          </a>
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
            <h5 class="fa fa-trash"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="attachment-body-content">
            <form id="edit-form" class="form-horizontal" method="POST" action="">
              <div class="card text-white bg-dark mb-0">
                <div class="card-header">
                  <h2 class="m-0">Edit</h2>
                </div>
                <div class="card-body">
                  <!-- id -->
                  <div class="form-group">
                    <label class="col-form-label" for="modal-input-id">Id (just for reference not meant to be shown to the general public) </label>
                    <input type="text" name="modal-input-id" class="form-control" id="modal-input-id" required>
                  </div>
                  <!-- /id -->
                  <!-- name -->
                  <div class="form-group">
                    <label class="col-form-label" for="modal-input-name">Name</label>
                    <input type="text" name="modal-input-name" class="form-control" id="modal-input-name" required autofocus>
                  </div>
                  <!-- /name -->
                  <!-- description -->
                  <div class="form-group">
                    <label class="col-form-label" for="modal-input-description">Email</label>
                    <input type="text" name="modal-input-description" class="form-control" id="modal-input-description" required>
                  </div>
                  <!-- /description -->
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button id="btn-yes" type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
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
    $(document).ready(function () {
      $('#tablecontact').DataTable();
    });

    function delCategory(id){

        Swal.fire({
          title: 'Hapus Kategori ?',
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
                url: "{{url('/admin/hapus-kategori')}}"+'/'+id,
                data: {id:id},
                success: function (data) {
                    Swal.fire({
                       title: 'Sukses',
                       text: 'Kategori berhasil di hapus',
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