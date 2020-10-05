@extends('template-nocart')
@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-item" style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li aria-current="page">&nbsp; | Cara Berbelanja</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 col-md-6 mb-5">
                <div class="mx-auto item_product h-100">
                    <div class="row card-body">
                    <div class="col-12 col-md-4 float-left my-auto d-none d-md-inline-block">
                        <img src="assets/image/carabelanja-search.png" class="card-img-top" alt="...">
                    </div>
                    <div class="col-12 col-md-8 float-right my-auto">
                        <h5 class="card-title">1. Cari Produk</h5>
                        <img src="assets/image/search_product.png" class="card-img-top d-md-none d-inline-block" alt="...">
                        <p>Di Baby Stardaz Shop terdapat banyak pilihan untuk kebutuhan harian kamu, dan dapat dilihat dan dicari di halaman utama dan category.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-5">
                <div class="mx-auto item_product h-100">
                    <div class="row card-body">
                    <div class="col-12 col-md-4 float-left my-auto d-none d-md-inline-block">
                        <img src="{{ asset('assets/image/carabelanja-addtocart.png') }}" class="card-img-top" alt="...">
                    </div>
                    <div class="col-12 col-md-8 float-right my-auto">
                        <h5 class="card-title">2. Masukkan dalam keranjang belanja</h5>
                        <img src="{{ asset('assets/image/add_to_cart.png') }}" class="card-img-top d-md-none d-inline-block" alt="...">
                        <p>Bila kamu sudah menemukannya, masukkan pilihan produk yang kamu
                            butuhkan dengan menekan tombol Add to Cart pada bagian bawah.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 col-md-6 mb-5">
                <div class="mx-auto item_product h-100">
                    <div class="row card-body">
                    <div class="col-12 col-md-4 float-left my-auto d-none d-md-inline-block">
                        <img src="{{ asset('assets/image/carabelanja-addocument.png') }}" class="card-img-top" alt="...">
                    </div>
                    <div class="col-12 col-md-8 float-right my-auto">
                        <h5 class="card-title">3. Isi Data</h5>
                        <img src="{{ asset('assets/image/add_document.png') }}" class="card-img-top d-md-none d-inline-block" alt="...">
                        <p>Proses bisa kamu lanjutkan dengan mengisi data pemesan, penerima, dan pengiriman.
                            Lalu kamu konfirmasikan daftar ini di halaman Konfirmasi Pemesanan sebelum kamu
                            mengirimkan kepada admin Baby Stardaz Shop.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 mb-5">
                <div class="mx-auto item_product h-100">
                    <div class="row card-body">
                    <div class="col-12 col-md-4 float-left my-auto d-none d-md-inline-block">
                        <img src="{{ asset('assets/image/carabelanja-confirmed.png') }}" class="card-img-top" alt="...">
                    </div>
                    <div class="col-12 col-md-8 float-right my-auto">
                        <h5 class="card-title">4. Konfirmasi via WhatsApp</h5>
                        <img src="{{ asset('assets/image/order_confirmed.png') }}" class="card-img-top d-md-none d-inline-block" alt="...">
                        <p>Bila sudah dipastikan, tinggal tekan tombol Kirim Pesanan ke Imaji Shop.
                            Order yang kamu masukkan akan secara otomatis kami buatkan dan kamu tinggal
                            menyampaikannya kepada admin WhatsApp kami.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
