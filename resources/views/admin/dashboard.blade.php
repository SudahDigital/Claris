@extends('admin.master')
@section('title') Dashboard @endsection
@section('title2') Dashboard @endsection
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
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        Hi {{ auth()->user()->name }}, You are logged in !
      </div>
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
    // alert($('#status_data').val());
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
      title: 'Successfully saved New Password'
    });
  }else if(popup == 'failed'){
    toastMixin.fire({
      title: 'Failed saved Password, Please Check Password !',
      icon: 'error'
    });
  }

  $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

</body>
</html>

@endsection
