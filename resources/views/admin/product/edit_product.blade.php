@extends('admin.master')
@section('title') Product List @endsection
@section('title2') Manage Product @endsection
@section('content')

<section class="content">
  <form method="post" action="{{route('edit_produk')}}" enctype="multipart/form-data"> <!-- method="post" action="{{route('cart_pay')}}" -->
    @csrf
    <div class="row section_content mb-5" style="margin-bottom: 30px">
        <div class="col-md-12">
            <div class="card mx-auto cart_card">
                <div class="card-header">
                    <h3 class="card-title">Edit Produk</h3>
                </div>
                <div class="card-body col-md-12 row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="upl_image">Upload Gambar</label>
                      <div class="form-line">
                        @if($image_nama)
                          <img id="upl_image2" src="{{asset('assets/image/product/'.$image_nama)}}" width="120px"/>
                        @else
                          No Image
                        @endif
                      </div>
                      <div class="input-group">
                          <div class="custom-file">
                              <input type="file" id="upl_image" name="upl_image" accept="image/*" autocomplete="off">
                              <span id="old_image"><b>({{ $image_nama }})</b></span>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="produk_kode">Product Code</label>
                        <input type="text" required="true" name="produk_kode" class="form-control" placeholder="Produk Kode" id="produk_kode"required autofocus autocomplete="off" value="{{ $produk_kode }}">
                    </div>
                    <div class="form-group">
                        <label for="produk_nama">Product Name</label>
                        <input type="text" required="true" name="produk_nama" class="form-control" placeholder="Produk Nama" id="produk_nama"required autofocus autocomplete="off" value="{{ $produk_nama }}">
                        <input type="hidden" name="produk_id" id="produk_id" value="{{ $produk_id }}">
                    </div>
                    <div class="form-group">
                        <label for="ket_produk">Product Description</label>
                        <textarea class="form-control" required="true"  name="ket_produk" rows="5" placeholder="Keterangan Produk" id="ket_produk" required autocomplete="off">{{ $produk_desc }}</textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Category</label>
                      <select class="form-control" required="true"  name="kat_produk"  id="kat_produk" required autofocus autocomplete="off">
                        <option value="">--</option>
                        @foreach($kategori as $key => $value)
                          <option value="{{ $value->id }}" <?php if($produk_kategori==$value->id) echo "selected"; ?> >{{ $value->id }} - {{ $value->category_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="harga_produk">Product Price (Rp)</label>
                      <input type="number" required="true" name="harga_produk" class="form-control" placeholder="Harga Produk" id="harga_produk"required autofocus autocomplete="off" value="{{ $produk_harga }}">
                    </div>
                    <div class="form-group">
                      <label for="diskon_produk">Product Stock (Pcs)</label>
                      <input maxlength="3" type="number" required="true" name="stock_produk" class="form-control" placeholder="Ex: 10" id="stock_produk" required autofocus autocomplete="off" value="{{ $produk_stock }}">
                    </div>
                    <div class="form-group">
                      <label for="diskon_produk">Product Discount (%)</label>
                      <input maxlength="3" type="number" name="diskon_produk" class="form-control" placeholder="Ex: 70" id="diskon_produk" autofocus autocomplete="off" value="{{ $diskon_produk }}">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="top_produk" name="top_produk" value="Y">
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $("#upl_image").on('change', function(){
        $("#old_image").html('');
        $("#upl_image2").hide();
    });

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
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
</body>
</html>

@endsection
