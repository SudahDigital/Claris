 @extends('template')
@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-item" style="color: #000 !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page"><b>Detail Produk</b></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 col-md-4 mb-3">
                <div class="card mx-auto" style="width: 300px; border: none; margin-bottom: 20px;">
                    <img src="{{ asset('assets/image/product/'.(($product->product_image!='') ? $product->product_image : 'none.jpg').'') }}" class="card-img-top img-fluid " alt="..." style="border-radius: 30px;">
                </div>
            </div>
            <div class="col-sm-12 col-md-8 mb-3">
                <div class="card mx-auto" style="border: none; background-color: #fff; border-radius: 20px;">
                    <div class="card-body">
                        <h5 class="card-title product-name px-1 pt-3"><b>{{$product->product_name}}</b></h5>
                        <h3 class="card-title product-name px-1" style="color: #41B1CD; font-weight: bold;"><strong><b>Rp {{ number_format($product->product_harga, 0, ',', '.') }},-</b></strong></h3>
                        <p class="product-description px-1"><b>{{$product->product_description}}</b></p>
                        <!-- <div class="row col-6 py-4 px-0 ">  -->
                            <!--detail-->
                            <!-- <div class="col-2 p-0" style="text-align: right;">
                                <button class="btn button_plus d-inline-display" onclick="button_minus_br('{{$product->id}}')" style="padding: 0; border-radius: 100%; background-color: #fff; color:#000;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
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
                            </div> -->

                            <!-- <div class="" style="background-color: #fff; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"> -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="float-left text-center">
                                                <a class="btn button_plus d-inline-display" onclick="button_minus_br('{{$product->id}}')" style="padding: 0; border-radius: 100%; color:#000;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                    <?php
                                                        $ses_id = \Request::header('User-Agent');
                                                        $clientIP = \Request::getClientIp(true);
                                                        $user = $ses_id.$clientIP;

                                                        // $sql = \DB::select("SELECT A.id, B.mount FROM products AS A LEFT JOIN (SELECT carts.mount, carts.session_id, carts.product_id FROM carts WHERE carts.session_id = '".$user."') AS B ON A.id = B.product_id"); 

                                                        $sql = \DB::select("SELECT A.id, B.mount FROM carts AS B LEFT JOIN (SELECT products.id FROM products) AS A ON A.id = B.product_id WHERE B.session_id = '".$user."' AND A.id = '".$product->id."' "); 
                                                        $rst = count($sql);

                                                        if($rst > 0){
                                                            foreach ($sql as $key => $val_a) {
                                                                echo '<span id="show_'.$val_a->id.'" class="d-inline title-dtl" style="color: #000 !important; border-radius: 5px; padding: 2px; font-weight: bold; text-align: center;">'.$val_a->mount.'</span>';
                                                            }
                                                        }else{
                                                            echo '<span id="show_'.$product->id.'" class="d-inline title-dtl" style="color: #000 !important; border-radius: 5px; padding: 2px; font-weight: bold; text-align: center;">0</span>';
                                                        }
                                                    ?>
                                                <a class="btn button_plus " onclick="button_plus_br('{{$product->id}}')" style="padding: 0; border-radius: 100%; color:#000;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            @csrf
                                            <input type="hidden" id="{{$product->id}}" name="jumlah" id="jumlah" value="0">
                                            <input type="hidden" id="harga_{{$product->id}}" name="harga_{{$product->id}}" value="{{ $product->product_harga }}">
                                            <input type="hidden" id="product_id_{{$product->id}}" name="product_id_{{$product->id}}" value="{{$product->id}}">
                                            <a onclick="insertCart('{{ $product->id }}')" type="button" class="btn button_filter float-right" style="color: #fff; font-size: 17px;"><b> Tambah</b></a>
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                        <!-- </div> -->
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
            var jum = $('#show_'+id).html();
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
            var jum = $('#show_'+id).html();
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

                // Swal.fire({
                //     title: 'Sukses',
                //     text: 'Item Berhasil dimasukan kekeranjang',
                //     icon: 'success',
                //    showConfirmButton: false,
                //    timer: 1500
                // }).then(function(){ 
                //     location.reload();
                // });
            }
        }

        function insertCart(id){
            var product     = $('#product_id_'+id).val();
            var mount       = $('#'+id).val();
            var price       = $('#harga_'+id).val();
            var mount_cart  = $('#show_'+id).html();

            $.ajax({
                url: '/cart/update_cart?id='+id+'&product_id='+id+'&jumlah='+mount,
                data:{
                        id : id,
                        product_id : product,
                        jumlah : mount
                    }, 
                success : function(data){
                    if (data['status']=='success') {

                        var total_price = parseFloat(data['total_price']);
                        var prc = (total_price/1000).toFixed(3);
                        $('#total_mount').html('<strong>Rp. '+prc+'</strong>');

                        var harga           = $('#harga_'+id).val();
                        var harga_mount     = $('#show_'+id).html();
                        var harga_mount1    = parseInt(harga) * parseInt(harga_mount);
                        harga_mount2        = (harga_mount1/1000).toFixed(3);
                        $('#mount2_'+id).html('Rp. '+harga_mount2);

                        /*Swal.fire({
                            title: 'Sukses',
                            text: 'Item Berhasil dimasukan kekeranjang',
                            icon: 'success',
                           showConfirmButton: false,
                           timer: 1500
                        })*/

                        var toastMixin = Swal.mixin({
                            toast: true,
                            icon: 'success',
                            title: 'General Title',
                            animation: false,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        toastMixin.fire({
                            animation: true,
                            title: 'Item Berhasil dimasukan kekeranjang'
                        });
                    }
                }
            })
        }
    </script>
@endsection
