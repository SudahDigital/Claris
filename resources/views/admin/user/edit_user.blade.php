@extends('admin.master')
@section('title') User List @endsection
@section('title2') Manage User Admin @endsection
@section('content')

<section class="content">
  <form method="post" action="{{route('edit_user')}}" enctype="multipart/form-data">
    @csrf
    <div class="row section_content mb-5" style="margin-bottom: 30px">
        <div class="col-md-12">
            <div class="card mx-auto cart_card">
                <div class="card-header">
                    <h3 class="card-title">Form Input</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="produk_nama">Username <span style="color: red;">*</span></label>
                        <input type="text" required="true" name="user_nama" class="form-control" placeholder="Username" id="user_nama" value="{{ $username }}" required autofocus autocomplete="off">
                        <input type="hidden" name="id" id="id" value="{{ $id }}">
                    </div>
                    <div class="form-group">
                          <label for="produk_nama">Full Name <span style="color: red;">*</span></label>
                          <input type="text" required="true" name="full_nama" class="form-control" placeholder="Full Name" id="full_nama" value="{{ $full_name }}" required autofocus autocomplete="off" >
                      </div>
                    <div class="form-group">
                        <label for="ket_produk">Email <span style="color: red;">*</span></label>
                        <input class="form-control" required="true" type="email" name="email_user" placeholder="Email User" id="email_user" value="{{ $email }}" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Password <span style="color: red;">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password" maxlength="15" autofocus autocomplete="off">
                        <input type="checkbox" onclick="myPass()"> Show Password
                    </div>
                    <div class="form-group">
                      <label>User Status <span style="color: red;">*</span></label>
                      <select class="form-control" required="true"  name="status"  id="role_user" >
                        <option value="admin" <?php if($role_user=='admin') echo "selected"; ?> >ADMIN</option>
                        <option value="superadmin" <?php if($role_user=='superadmin') echo "selected"; ?> >SUPER ADMIN</option>
                      </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a type="cancel" class="btn btn-warning" href="{{URL::route('dash_user')}}">Cancel</a>
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
