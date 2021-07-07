@extends('admin.master')
@section('title') Color List @endsection
@section('title2') Manage Color Product @endsection
@section('content')

<section class="content">
   <form method="post" action="{{route('edit_color')}}">
        @csrf
        <div class="row section_content mb-5" style="margin-bottom: 30px">
            <div class="col-md-12">
                <div class="card mx-auto cart_card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="produk_nama">Color ID</label>
                            <input type="text" required="true" name="color_id" class="form-control" placeholder="Color ID" id="color_id" required autofocus autocomplete="off" value="{{$color_id}}">
                            <input type="hidden" name="clr_id" id="clr_id" value="{{$id}}">
                        </div>
                        <div class="form-group">
                            <label for="produk_nama">Color Name</label>
                            <input type="text" required="true" name="color_name" class="form-control" placeholder="Color Name" id="color_name" required autofocus autocomplete="off" value="{{$color_name}}">
                        </div>
                        <div class="form-group">
                            <label for="produk_nama">Color code</label><br>
                            <input type="color" id="color_code" name="color_code" value="{{$color_code}}">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-warning" href="{{ route('index_color') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

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

@endsection
