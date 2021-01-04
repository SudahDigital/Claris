@include('admin.contact.dash_contact')
    <!-- Main content -->
    <section class="content">
       <form method="post" action="{{route('edit_kontak')}}">
        @csrf
        <div class="row section_content mb-5" style="margin-bottom: 30px">
            <div class="col-md-12">
                <div class="card mx-auto cart_card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Contact</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="produk_nama">Email</label>
                            <input type="text" required="true" max="50" name="email" class="form-control" placeholder="Email" id="email" required autofocus autocomplete="off" value="{{ $email }}">
                        </div>
                        <div class="form-group">
                            <label for="produk_nama">No Telepon</label>
                            <input type="text" required="true" max="15" name="no_telp" class="form-control" placeholder="Nomer Telepon" id="no_telp"required autofocus autocomplete="off" value="{{ $no_telp }}">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="cancel" class="btn btn-warning" href="{{URL::route('dash_kontak')}}">Cancel</a>
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
</div>

<script type="text/javascript">
    // function tes(){
    //     alert('jalan');
    // }
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