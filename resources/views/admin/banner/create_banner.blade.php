@extends('admin.master')
@section('title') Banner List @endsection
@section('title2') Manage Banner @endsection
@section('content')

<section class="content">
   <form method="post" action="{{route('input_banner')}}" enctype="multipart/form-data">
      @csrf
      <div class="row section_content mb-5" style="margin-bottom: 30px">
          <div class="col-md-12">
              <div class="card mx-auto cart_card">
                  <div class="card-header">
                      <h3 class="card-title">Upload</h3>
                  </div>
                  <div class="card-body">
                      <div class="form-group">
                        <label>Upload Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="upl_image" name="upl_image" accept="image/*" required autocomplete="off">
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a type="cancel" class="btn btn-warning" href="{{URL::route('dash_banner')}}">Cancel</a>
                  </div>
              </div>
          </div>
      </div>
    </form>
</section>

<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">
    // $(document).ready(function() { 
    //   alert('tes');
    // });

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

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

@endsection
