 @extends('template')
@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-item" style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 col-md-4 mb-3">
                <div class="card mx-auto" style="width: 300px; border: none; margin-bottom: 20px;">
                    <img src="{{ asset('assets/image/product/'.(($product->image_link!='') ? $product->image_link : 'none.jpg').'') }}" class="card-img-top img-fluid " alt="...">
                </div>
            </div>
            <div class="col-sm-12 col-md-8 mb-3">
                <div class="card mx-auto" style="border: none; background-color: #FDFFBA; border-radius: 20px;">
                    <div class="card-body m-0 p-0">
                        <h5 class="card-title product-name px-1 pt-3">{{$product->product_name}}</h5>
                        <h3 class="card-title product-name px-1" style="color: #41B1CD; font-weight: bold;"><strong>Rp {{ number_format($product->product_harga, 0, ',', '.') }},-</strong></h3>
                        <p class="product-description px-1">{{$product->product_description}}</p>
                        <div class="row col-6 py-4 px-0 detail">
                            <div class="col-2 p-0" style="text-align: right;">
                                 <!-- <form method="post" action="{{route('add_cart')}}">
                                    @csrf
                                    <input type="hidden" id="{{$product->id}}" name="jumlah" value="1">
                                    <input type="hidden" id="harga{{$product->id}}" name="harga" value="{{ $product->product_harga }}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}"> -->
                                    <button class="btn button_plus d-inline-display" onclick="button_minus_br('{{$product->id}}')" style="padding: 0; border-radius: 100%; background-color: #fff; color:#000;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                <!-- </form> -->
                            </div>
                            <div class="col-2" style="text-align: right;">
                                <p id="show_{{$product->id}}" class="d-inline" style="color: #000 !important; font-size: 15px; border-radius: 5px; padding: 2px; font-weight: bold; text-align: center">0</p>
                            </div>
                            <div class="col-2" style="text-align: right;">
                                <form method="post" action="{{route('add_cart')}}">
                                    @csrf
                                    <input type="hidden" id="{{$product->id}}" name="jumlah" value="0">
                                    <input type="hidden" id="harga{{$product->id}}" name="harga" value="{{ $product->product_harga }}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button class="btn button_plus d-inline-display" onclick="button_plus_br('{{$product->id}}')" style="padding: 0; border-radius: 100%; background-color: #fff; color:#000;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row section_content">
                    <div class="col-12 mb-5">
                        <div class="mx-auto">
                            <div class="clearfix">
                                <form method="post" action="{{route('add_cart')}}">
                                    @csrf
                                    <input type="hidden" id="{{$product->id}}" name="jumlah" value="1">
                                    <input type="hidden" id="harga{{$product->id}}" name="harga" value="{{ $product->product_harga }}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button class="btn btn-block" style="background-color: #EA7D08; color: #fff;">Tambah Ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
       <!--  <div class="row section_content">
            <div class="col-12 mb-5">
                <div class="mx-auto">
                    <div class="clearfix">
                        <form method="post" action="{{route('add_cart')}}">
                            @csrf
                            <input type="hidden" id="{{$product->id}}" name="jumlah" value="1">
                            <input type="hidden" id="harga{{$product->id}}" name="harga" value="{{ $product->product_harga }}">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button class="btn btn-block btn-success button_add_to_cart">Tambah Ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <br><br><br><br><br><br>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function button_minus_br(id)
        {
            var jum = $('#'+id).val();
            var jumlah = parseInt(jum) - 1;

            // AMBIL NILAI HARGA
            var harga = $('#harga'+id).val();;
            var harga = parseInt(harga) * jumlah;

            // UBAH FORMAT UANG INDONESIA
            var number_string = harga.toString();
            var sisa    = number_string.length % 3;
            var rupiah  = number_string.substr(0, sisa);
            var ribuan  = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
              separator = sisa ? '.' : '';
              rupiah += separator + ribuan.join('.');
            }

            harga = "Rp " + rupiah;

            // alert(jumlah);

            if (jumlah<1) {
              // alert('Jumlah Tidak Boleh Kurang dari 0')
                Swal.fire({
                    title: 'Failed',
                    text: 'Jumlah Tidak Boleh Kurang dari 0',
                    icon: 'warning',
                   showConfirmButton: false,
                   timer: 1500
                })
                /*.then(function(){ 
                    location.reload();})*/
                ;
            } else {
              $('#'+id).val(jumlah);
              $('#show_'+id).html(jumlah);
              $('#productPrice'+id).text(harga);
            }
        }

        function button_plus_br(id)
        {
            var jum = $('#'+id).val();
            var jumlah = parseInt(jum) + 1;
            // alert(jum);

            // AMBIL NILAI HARGA
            var harga = $('#harga'+id).val();;
            var harga = parseInt(harga) * jumlah;

            // UBAH FORMAT UANG INDONESIA
            var number_string = harga.toString();
            var sisa    = number_string.length % 3;
            var rupiah  = number_string.substr(0, sisa);
            var ribuan  = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
              separator = sisa ? '.' : '';
              rupiah += separator + ribuan.join('.');
            }

            harga = "Rp " + rupiah;
            
            // alert(jumlah)
            if (jumlah<0) { 
              alert('Jumlah Tidak Boleh Kosong')
            } else {

              $('#'+id).val(jumlah)
              $('#show_'+id).html(jumlah)
              $('#productPrice'+id).text(harga);

                Swal.fire({
                    title: 'Sukses',
                    text: 'Item Berhasil dimasukan kekeranjang',
                    icon: 'success',
                   showConfirmButton: false,
                   timer: 1500
                }).then(function(){ 
                    location.reload();
                });
            }
        }
    </script>
@endsection
