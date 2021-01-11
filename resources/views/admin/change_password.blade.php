@extends('admin.master')
@section('title') @endsection
@section('title2') Change Password @endsection
@section('content')

<section class="content mb-5">
  <form method="get" action="{{route('update_pass')}}" enctype="multipart/form-data">
    @csrf
    <div class="row section_content mb-5" style="margin-bottom: 30px">
        <div class="col-md-12">
            <div class="card mx-auto cart_card">
                <div class="card-header ">
                    <h3 class="card-title "><b>Set a New Password</b></h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="harga_produk">New Password <span style="color: red;">*</span></label>
                        <input type="password" required="true" name="password" class="form-control" placeholder="New Password" id="password" maxlength="15" required autofocus autocomplete="off">
                        <input type="checkbox" onclick="myPass()"> Show
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Confirm Password <span style="color: red;">*</span></label>
                        <input type="password" required="true" name="passwordCofirm" class="form-control" placeholder="Confirm Password" id="passwordCofirm" maxlength="15" required autofocus autocomplete="off">
                        <input type="checkbox" onclick="myPassConfirm()"> Show
                        <input type="hidden" name="name_user" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="email_user" value="{{ auth()->user()->email }}">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a type="cancel" class="btn btn-warning" href="{{URL::route('dashboard')}}">Cancel</a>
                </div>
            </div>
        </div>
    </div>
  </form>
</section>

<script type="text/javascript">
  function myPass() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  function myPassConfirm() {
    var x = document.getElementById("passwordCofirm");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
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
@endsection
