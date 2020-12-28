@include('admin.category.dash_category')
    <!-- Main content -->
    <section class="content">
       <form method="post" action="{{route('edit_kategori')}}">
        @csrf
        <div class="row section_content mb-5" style="margin-bottom: 30px">
            <div class="col-md-12">
                <div class="card mx-auto cart_card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="produk_nama">Category Name</label>
                            <input type="text" required="true" name="kategori_nama" class="form-control" placeholder="Nama Kategori" id="kategori_nama"required autofocus autocomplete="off" value="{{ $kategori_nama }}">
                            <input type="hidden" name="kategori_id" id="kategori_id" value="{{ $kategori_id }}">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a class="btn btn-warning" href="{{ route('dash_kategori') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

  @include('admin.footer')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    function tes(){
        alert('jalan');
    }
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script src="{{ asset('assets/js/main.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- jQuery -->
<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
</body>
</html>
