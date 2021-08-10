@extends('admin.master')
@section('title') Area List @endsection
@section('title2') Manage Whatsapp Area @endsection
@section('content')

<section class="content">
   <form method="post" action="{{route('input_area_number')}}">
        @csrf
        <div class="row section_content mb-5" style="margin-bottom: 30px">
            <div class="col-md-12">
                <div class="card mx-auto cart_card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Form Input</h3>
                    </div> -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="area_name">Area Name</label>
                            <input type="text" required="true" name="area_name" class="form-control" placeholder="Area Name" id="area_name"required autofocus autocomplete="off">
                        </div>
                        <div class="form-group form-float">
                            <label for="produk_nama">Area Whatsapp Number</label>
                            <div class="form-line">
                                <div class="input-group">
                                    <span class="input-group-addon" style="align-self: center; font-weight: bold;">+62&nbsp;</span>
                                    <input type="text" required="true" name="area_number" class="form-control" placeholder="81111111xxx" maxlength="12" id="area_number"required onkeyup="onlyNumber(this.value)">
                                </div>
                            </div>
                            <!-- <div class="help-info"><small>Example : 6281111111111</small></div> -->
                        </div>
                        <div class="form-group">
                            <label for="produk_nama">Area</label>
                            <select multiple class="form-control" required="true"  name="area[]"  id="area[]" required autofocus autocomplete="off" style="height: 250px;">
                              @foreach($cities as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->id }} - {{ $value->city_name }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-warning" href="{{ route('dash_area_number') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<script type="text/javascript">
    function onlyNumber(value){
        var val = value;
        var num = val.replace(/[^0-9]+/g, '');
        return document.getElementById("area_number").value = num;
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
