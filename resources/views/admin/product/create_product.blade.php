@extends('admin.master')
@section('title') Product List @endsection
@section('title2') Manage Product @endsection
@section('content')
<section class="content">
  <form method="post" action="{{route('input_produk')}}" enctype="multipart/form-data">
    @csrf
    <div class="row section_content mb-5" style="margin-bottom: 30px">
        <div class="col-md-12">
            <div class="card mx-auto cart_card">
                <div class="card-body col-md-12 row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Upload Image Product</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="upl_image" name="upl_image" accept="image/*" required autocomplete="off">
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="produk_nama">Product Name</label>
                        <input type="text" required="true" name="produk_nama" class="form-control" id="produk_nama"required autofocus autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label for="ket_produk">Product Description</label>
                        <textarea class="form-control" required="true"  name="ket_produk" rows="5" id="ket_produk" required autocomplete="off"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control" required="true"  name="kat_produk"  id="kat_produk" required autofocus autocomplete="off">
                          <option value="">--</option>
                          @foreach($category as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->id }} - {{ $value->category_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="harga_produk">Product Price (Rp)</label>
                        <input type="number" required="true" name="harga_produk" class="form-control" placeholder="Ex: 150000" id="harga_produk" required autofocus autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label for="diskon_produk">Product Stock (Pcs)</label>
                        <input maxlength="3" type="number" required="true" name="stock_produk" class="form-control" placeholder="Ex: 10" id="stock_produk" required autofocus autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label for="diskon_produk">Product Discount (%)</label>
                        <input maxlength="3" type="number" name="diskon_produk" class="form-control" placeholder="Ex: 70" id="diskon_produk" autofocus autocomplete="off">
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="form-control custom-control-input" type="checkbox" id="top_produk" name="top_produk" value="Y">
                          <label class="custom-control-label" for="top_produk">TOP PRODUCT</label>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-warning" href="{{ route('dash_produk') }}">Cancel</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
</body>
</html>

@endsection
