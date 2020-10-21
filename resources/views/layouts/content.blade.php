@extends('template')
@section('content')
    <div class="banner">
        <img src="{{ asset('assets/image/2.jpg') }}" style="width:100%;">
        <div class="img-banner"><img src="{{ asset('assets/image/logo_cool.png') }}" style="width: 30%;"></div>
        <!-- <div class="txt-banner"> Menjadi ibu rumah tangga yang aktif dan produktif merupakan suatu hal yang positif untuk dibagikan selain menjadi penopang dalam rumah tangga , anda bisa mengisi keseharian anda dengan banyak hal-hal yang positif. Temukan inspirasi-inspirasi menarik seperti mengatur tatanan rumah, memasak dan bermacam-macam hobi yang bisa anda lakukan.</div> -->
    </div>
    <div class="banner">
        <img src="{{ asset('assets/image/banner02.jpg') }}"  style="width:100%;">
    </div>
    <div class="container" style="{{ $page == 'home' ? 'margin-top: 30px' : 'margin-top: 80px' }}">
        <div class="row align-middle" style="{{ $page == 'home' ? 'margin-bottom: 20px' : 'margin-bottom: 10px' }}">
            <div class="col-sm-12 order-2 order-md-1">
                @if($page == 'home')
                    <!-- <h3 class="title-page">Semua Produk</h3> -->
                    <h3 class="title-page">Filter by Category <button type="button" class="btn" data-toggle="collapse" data-target="#demo" style="background-color: #fff;">
                        <i class="fas fa-sliders-h fa-xs"></i>
                    </button></h3>

                    <div id="demo" class="collapse" style="">
                        <div class="col-md-12 " style="margin-bottom: 20px;">
                        <a href="{{ url('/') }}"><button class="btn button_filter" style="color: #fff;">Semua Produk</button></a>
                        @foreach($category as $key => $value)
                            <a href="{{route('product_category', ['id'=>$value->id, 'category_name'=>$value->category_name] )}}" type="button" class="btn button_filter" style="color: #fff;">{{$value->category_name}}</a>
                        @endforeach
                        </div>
                    </div> 
                @endif
            </div>
            @if($page == 'category')
                <div class="col-sm-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb px-0 button_breadcrumb">
                            <li class="breadcrumb-item" style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category_name }}</li>
                        </ol>
                    </nav>
                </div>
            @elseif($page == 'search')
                <div class="col-sm-12 col-md-12" style="margin: 10px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 button_breadcrumb">
                            <li class="breadcrumb-item" style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pencarian</li>
                        </ol>
                    </nav>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="row section_content">
                @if(count($product) < 1)
                    <h5 class="ml-3">Pencarian tidak ditemukan!</h5>
                @endif
                @foreach($product as $key => $value)
                    <div class="col-6 col-lg-4 mb-5">  <!--px-5 py-2-->
                        <div class="card mx-auto item_product" style="border: 0,5px solid #E1DFDC; border-radius: 45px; box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1); ">
                            <?php
                                $bg = ['#D4088D','#EA7D08','#8AE50F','#D4088D','#EA7D08','#8AE50F','#D4088D','#EA7D08','#8AE50F','#D4088D','#EA7D08','#8AE50F','#D4088D','#EA7D08','#8AE50F','#D4088D','#EA7D08','#8AE50F'];
                                echo '<div id="nmprd" class="text-center" style="background-color: '.$bg[$key].' ; padding:12px; border-top-right-radius: 40px;border-top-left-radius: 40px; color: #fff;">Detail Produk</div>';
                            ?>
                            <!-- <div class="text-center" style="background-color:yellow; padding:15px; border-top-right-radius: 60px;border-top-left-radius: 60px; color: #fff;"> -->
                            <div class="card-img-top" style="position: relative;">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="embed-responsive-item">
                                        <a href="{{URL::route('product_detail', ['id'=>$value->id, 'product_name'=>urlencode($value->product_name)])}}">
                                            <img src="{{ asset('assets/image/product/'.(($value->image_link!='') ? $value->image_link : 'none.jpg').'') }}" class="img-fluid img-responsive" alt="...">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0" style="background-color: #fff !important;">
                                <div class="float-left px-1 py-0" style="width: 100%;">
                                    <p class="product-price-header mb-0" style="color: #000 !important;">{{$value->product_name}}</p>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="float-middle px-1 py-0 " style="width: 100%;">
                                    <p style="color: #41B1CD;" class="label-harga mb-0"><strong>Rp {{ number_format($value->product_harga, 0, ',', '.') }},-</strong></p>
                                </div>
                            </div>
                            <div class="button-cart">
                                <div class="row">
                                    <div class="col-2 p-0" style="text-align: center;">
                                        <form method="post" action="{{route('add_cart')}}">
                                            @csrf
                                            <input type="hidden" id="{{$value->id}}" name="jumlah" value="1">
                                            <input type="hidden" id="harga{{$value->id}}" name="harga" value="{{ $value->product_harga }}">
                                            <input type="hidden" name="product_id" value="{{$value->id}}">
                                            <button class="btn button_plus d-inline-display" onclick="button_plus_br('{{$value->id}}')" style="padding: 0; border-radius: 100%; background-color: #fff; color:#000;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-2" style="text-align: center;">
                                        <p id="show_{{$value->id}}" class="d-inline" style="color: #000 !important; font-size: 15px; border-radius: 5px; padding: 2px; font-weight: bold; text-align: center">0</p>
                                    </div>
                                    <div class="col-2" style="text-align: center;">
                                        <!-- <form method="post" action="{{route('add_cart')}}">
                                            @csrf
                                            <input type="hidden" id="{{$value->id}}" name="jumlah" value="1">
                                            <input type="hidden" id="harga{{$value->id}}" name="harga" value="{{ $value->product_harga }}">
                                            <input type="hidden" name="product_id" value="{{$value->id}}"> -->
                                            <button class="btn button_plus d-inline-display" onclick="button_minus_br('{{$value->id}}')" style="padding: 0; border-radius: 100%; background-color: #fff; color:#000;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center" >
                <div class="page" style="margin-top:0; margin-bottom:1rem;">
                    {{ $product->links() }}
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>
        <!-- Modal -->
        <div class="modal fade" id="modalCheckout" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" style="width: 100%; max-width:1700px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Keranjang Belanja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow-y: auto; max-height: calc(70vh - 210px);">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mx-auto cart_card">
                                    <div class="card-body table-responsive">
                                        <table class="table text-nowrap" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Gambar</th>
                                                    <th scope="col">Nama & Jumlah Produk</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Sub Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total = 0;
                                                    foreach($cart as $key => $value) {
                                                        $amount = $value->product_harga * $value->mount;
                                                        $total += $amount
                                                ?>
                                                    <tr>
                                                        <td class="align-middle w-25" scope="row">
                                                            <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/medium//92/MTA-7130791/gudang_sayur_gudang_sayur_-_sayur_pakchoy_-_pokchoy_-pok_choi_full01_tfvby22m.jpg?output-format=webp" class="card-img-top img-fluid">
                                                        </td>
                                                        <td class="align-middle">
                                                            <p>{{$value->product_name}}</p>
                                                            <div>
                                                                <button type="button" class="btn btn-success button_minus" style="padding: 0; text-align: center;">-</button>
                                                                <span class="mr-1 ml-1" id="show_m{{$value->id}}">{{$value->mount}}</span>
                                                                <button type="button" class="btn btn-success button_plus" style="padding: 0; text-align: center;">+</button>
                                                                <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                                                                <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                                                                <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                                                            </div>
                                                        </td>
                                                        <td class="align-middle"><p class="my-auto">Rp {{ number_format($value->product_harga, 0, ',', '.') }}</p></td>
                                                        <td class="align-middle" id="mount_{{$value->id}}"><p class="my-auto">Rp {{ number_format($amount, 0, ',', '.') }}</p></td>
                                                        <td class="align-middle"><a class="btn btn-sm btn-danger" href="{{route('cart_delete',$value->id)}}"><i class="fa fa-trash"></i></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="card-footer">
                                        <button type="submit" class="btn btn-success btn-block button_order">
                                            Pesan Sekarang
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block button_order">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function button_minus_br(id)
        {
            var jumlah = $('#'+id).val();
            var jumlah = parseInt(jumlah) - 1;

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

            if (jumlah<0) {
              alert('Jumlah Tidak Boleh Kurang dari 0')
            } else {
              $('#'+id).val(jum);
              $('#show_'+id).html(jum);
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

              $('#'+id).val(jum)
              $('#show_'+id).html(jum)
              $('#productPrice'+id).text(harga);

                Swal.fire({
                    title: 'Sukses',
                    text: 'Item Berhasil dimasukan kekeranjang',
                    icon: 'success'}).then(function(){ 
                    location.reload();
                });
            }
        }
    </script>
@endsection
