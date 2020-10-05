@extends('template')
@section('content')
    <div class="container" style="{{ $page == 'home' ? 'margin-top: 30px' : 'margin-top: 80px' }}">
        <div class="row align-middle" style="{{ $page == 'home' ? 'margin-bottom: 20px' : 'margin-bottom: 10px' }}">
            <div class="col-sm-12 col-md-6 order-2 order-md-1">
                @if($page == 'home')
                    <h3 class="title-page">Semua Produk</h3>
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
        <div class="row section_content">
            @if(count($product) < 1)
                <h5 class="ml-3">Pencarian tidak ditemukan!</h5>
            @endif
            @foreach($product as $key => $value)
                <div class="col-6 col-md-6 col-lg-3 mb-5">
                    <div class="card item_product " style="border: none;">
                        <div class="card-img-top" style="position: relative;">
                            <div class="embed-responsive embed-responsive-4by3">
                                <div class="embed-responsive-item">
                                    <a href="{{URL::route('product_detail', ['id'=>$value->id, 'product_name'=>urlencode($value->product_name)])}}">
                                        <img src="{{ asset('assets/image/product/'.(($value->image_link!='') ? $value->image_link : 'sleek.jpg').'') }}" class="img-fluid h-100 w-100 img-responsive" alt="..." style="border-radius: 25px;">
                                        <!-- <h5 class="card-title product-name px-1 py-2 mb-0" style="background-color: #4db849 !important; color: #fff !important; position: absolute; bottom: 0; width: 100%; opacity: 0.8;">{{$value->product_name}}</h5> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0" style="background-color: #fff !important;">
                            <div class="float-left px-1 py-2" style="width: 100%;">
                                <p class="product-price-header mb-0" style="color: #000 !important;">{{$value->product_name}}</p>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <p style="font-size: 20px">Rp {{ number_format($value->product_harga, 0, ',', '.') }},-</p>
                        </div>
                        <div class="card-body p-0">
                            <p><a class="fas fa-star" style="color: yellow;"></a> Rating</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="float-left px-2 py-2">
                                <form method="post" action="{{route('add_cart')}}">
                                    @csrf
                                    <input type="hidden" id="{{$value->id}}" name="jumlah" value="1">
                                    <input type="hidden" id="harga{{$value->id}}" name="harga" value="{{ $value->product_harga }}">
                                    <input type="hidden" name="product_id" value="{{$value->id}}">
                                    <button class="btn btn-block button_add_to_cart" style="color: #fff;">Tambah</button>
                                </form>
                            </div>
                            <div class="float-right px-1 py-2 text-center" style="width: 43%;">
                                <button class="btn button_plus d-inline-display" onclick="button_plus('{{$value->id}}')" style="padding: 0; text-align: center; border-radius: 100%; background-color: #fff;">+</button>
                                <p id="show_{{$value->id}}" class="d-inline" style="color: #000 !important; margin-left: 1px !important; margin-right: 1px !important;">1</p>
                                <button class="btn button_minus d-inline-display" onclick="button_minus('{{$value->id}}')" style="padding: 0; text-align: center; border-radius: 100%; background-color: #fff;">-</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="clearfix mt-3">
                        <form method="post" action="{{route('add_cart')}}">
                            @csrf
                            <input type="hidden" id="{{$value->id}}" name="jumlah" value="1">
                            <input type="hidden" id="harga{{$value->id}}" name="harga" value="{{ $value->product_harga }}">
                            <input type="hidden" name="product_id" value="{{$value->id}}">
                            <button class="btn btn-block btn-success button_add_to_cart">Tambah Ke Keranjang</button>
                        </form>
                    </div> -->
                </div>
            @endforeach
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-2">
                {{ $product->links() }}
            </div>
        </div>
        <br><br><br><br><br><br><br>
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
@endsection
