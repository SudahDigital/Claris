@extends('template-cart')
@section('content')
    <div class="container" style="margin-top: 70px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12 text-center" style="padding: 20px;">
                <!-- <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb"> -->
                        <span class="text-konfirmasi"><b>Konfirmasi Pesanan</b></span>
                    <!-- </ol>
                </nav> -->
            </div>
        </div>
        <form method="post" action="{{route('cart_pay')}}" class="form-horizontal">
            @csrf
            <div class="card-body view-pesanwa section_content mb-5">
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label" style="color: #fff;"><b>Nama</b></label>
                <div class="col-sm-10">
                  <input style=" border-radius: 30px;" type="text" name="costumer_name" class="form-control" id="name">
                </div>
              </div>
              <div class="form-group row">
                <label for="phoneNumber" class="col-sm-2 col-form-label" style="color: #fff;"><b>No. Telp/Handphone<b/></label>
                <div class="col-sm-10">
                  <input style=" border-radius: 30px;" type="number"  name="costumer_phone" class="form-control" id="phoneNumber" maxlength="12">
                </div>
              </div>
              <div class="form-group row">
                <label for="deliveryCity" class="col-sm-2 col-form-label" style="color: #fff;"><b>Kabupaten/Kota</b></label>
                <div class="col-sm-10">
                  <input style=" border-radius: 30px;" class="form-control"  name="costumer_city" id="deliveryCity">
                </div>
              </div>
              <div class="form-group row">
                <label for="deliveryAddress" class="col-sm-2 col-form-label" style="color: #fff;"><b>Detail Alamat</b></label>
                <div class="col-sm-10">
                  <textarea style=" border-radius: 30px;" class="form-control"  name="costumer_adress" id="deliveryAddress" rows="5"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label" style="color: #fff;"><b>Email</b></label>
                <div class="col-sm-10">
                  <input style="border-radius: 30px;" type="email"  name="costumer_email" class="form-control" id="email" >
                </div>
              </div>
              <div class="form-group row">
                <label for="kode_promo" class="col-sm-2 col-form-label" style="color: #fff;"><b>Code Promo</b></label>
                <div class="col-sm-10">
                  <input style=" border-radius: 30px;" class="form-control col-5"  name="kode_promo" id="kode_promo"></input>
                </div>
              </div>
              <div class="form-group form-syarat">
                <label style="color: #fff;"><b>Syarat dan ketentuan belanja dengan Whatsapp Delivery Claris</b></label>
                <textarea style=" border-radius: 30px; font-weight: bold;" class="form-control"  name="costumer_adress" id="deliveryAddress" rows="8" disabled>Syarat dan kententuan</textarea>
                <!-- <label for="phoneNumber" class="cart_label">Nomor Telepon</label> -->
              </div>
              <div class="text-center" style="float: center;">
                <a class="btn button_whatsapp" onclick="whatsapp();">
                    <img src="{{ asset('assets/image/logo-whatsapp.png') }}" alt="" style="width: 20px;">
                    <strong class="float-center" style="font-size: 15px;color: #fff;">Pesan Sekarang</strong>
                </a>
              </div>
            </div>

            @php
                $total = 0 ;
                $total_pay = 0 ;
                $total_brg = 0 ;
                $nm_brg = '';
            @endphp
            @foreach($cart as $key => $value)
                @php
                $amount = $value->product_harga * $value->mount;
                $total += $amount;
                $total_brg = count($cart);
                $total_pay += $amount;
                $nm_brg .= $value->product_name." (".$value->color."-".$value->mount."),";
                @endphp

                <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                <input type="hidden" id="total_brg" value="{{$total_brg}}">
            @endforeach
            @php
                $all_brg    = substr($nm_brg, 0, strlen($nm_brg) -1);
            @endphp
                <input type="hidden" id="nm_brg" value="{{$all_brg}}">
                <input type="hidden" name="total_pay" id="total_pay" value="{{$total}}">
        </form>

        <!-- <form method="post" action="{{route('cart_pay')}}" class="form-horizontal">
        @csrf
        <div class="section_content mb-5" style="margin-bottom: 30px; background-color: rgba(245, 245, 245, 0); ">
            <div class="col-12">
                <div class="card mx-auto cart_card" style="background-color: rgba(245, 245, 245, 0); border: none;">
                    <div class="card-body view-pesanwa">
                        <div class="form-group row">
                            <div class="col-2">
                                <label style="color: #fff;"><b>Nama</b></label>
                            </div>
                            <div class="col-10">
                                <input style=" border-radius: 30px;" type="text" name="costumer_name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="col-2">
                                <label style="color: #fff;"><b>No. Telp/Handphone<b/></label>   
                            </div>
                            <div class="col-10">
                                <input style=" border-radius: 30px;" type="number"  name="costumer_phone" class="form-control" id="phoneNumber" maxlength="12">
                            </div>
                        </div>  
                        <div class="input-group">
                            <div class="col-2">
                                <label style="color: #fff;"><b>Kabupaten/Kota</b></label>
                            </div>
                            <div class="col-10">
                                <input style=" border-radius: 30px;" class="form-control"  name="costumer_city" id="deliveryCity">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="col-2">
                                <label style="color: #fff;"><b>Detail Alamat</b></label>
                            </div>
                            <div class="col-10">
                                <textarea style=" border-radius: 30px;" class="form-control"  name="costumer_adress" id="deliveryAddress" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="col-2">
                                <label style="color: #fff;">Email</label>
                            </div>
                            <div class="col-10">
                                <input style="border-radius: 30px;" type="email"  name="costumer_email" class="form-control" id="email" >
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="col-2">
                                <label style="color: #fff;"><b>Kode Promo</b></label>
                            </div>
                            <div class="col-10">
                                <input style=" border-radius: 30px;" class="form-control col-5"  name="kode_promo" id="kode_promo"></input>
                            </div>
                        </div>
                        <div class="form-group form-syarat" style="padding-left: 25px; padding-right: 25px;">
                            <label style="color: #fff;"><b>Syarat dan ketentuan belanja dengan Whatsapp Delivery Claris</b></label>
                            <textarea style=" border-radius: 30px; font-weight: bold;" class="form-control"  name="costumer_adress" id="deliveryAddress" rows="8" disabled>Syarat dan kententuan</textarea>
                        </div>
                        <div class="text-center" style="float: center;">
                            <a class="btn button_whatsapp" onclick="whatsapp();">
                                <img src="{{ asset('assets/image/logo-whatsapp.png') }}" alt="" style="width: 20px;">
                                <strong class="float-center" style="font-size: 15px;color: #fff;">Pesan Sekarang</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $total = 0 ;
                $total_pay = 0 ;
                $total_brg = 0 ;
                $nm_brg = '';
                @endphp
                @foreach($cart as $key => $value)
                    @php
                    $amount = $value->product_harga * $value->mount;
                    $total += $amount;
                    $total_brg = count($cart);
                    $total_pay += $amount;
                    $nm_brg .= $value->product_name." (".$value->mount."),";
                    @endphp

                    <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                    <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                    <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                    <input type="hidden" id="total_brg" value="{{$total_brg}}">
                @endforeach
                @php
                    $all_brg    = substr($nm_brg, 0, strlen($nm_brg) -1);
                @endphp
                    <input type="hidden" id="nm_brg" value="{{$all_brg}}">
                    <input type="hidden" name="total_pay" id="total_pay" value="{{$total}}"> -->

            <!-- <div class="col-sm-12 col-md-8 mb-6">
                <div class="card mx-auto cart_card">
                    <div class="card-body table-responsive">
                        <table class="table" style="width: 100%;">
                            <tbody>
                                @php
                                 $total = 0 ;
                                 $total_pay = 0 ;
                                 $total_brg = 0 ;
                                 $nm_brg = '';
                                @endphp
                                @foreach($cart as $key => $value)
                                @php
                                $amount = $value->product_harga * $value->mount;
                                $total += $amount;
                                $total_brg = count($cart);
                                $total_pay += $amount;
                                $nm_brg .= $value->product_name." (".$value->mount."),";

                                @endphp
                                <tr>
                                    <td class="align-middle img-product" scope="row" style="width: 80px">
                                        <img src="{{ asset('assets/image/product/'.(($value->product_image!='') ? $value->product_image : 'none.jpg').'') }}" class="card-img-top img-fluid">
                                    </td>
                                    <td class="align-left">
                                        <h5 class="product-price-header2" style="color: #000 !important; font-weight: bold;">{{$value->product_name}}</h5><br>  
                                        <p class="label-harga2" id="mount3_{{$value->id}}" style="color: #41B1CD !important; text-align: left"><strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong></p>
                                            <button id="minus" value="{{$value->id}}" type="button" class="btn btn-primary button_minus" onclick="cart_minus('{{$value->id}}')" style="padding: 0; text-align: center;"><i class="fa fa-minus"></i></button>
                                            <span class="mr-1 ml-1" id="show_m3{{$value->id}}">{{$value->mount}}</span>
                                            <button id="plus" value="{{$value->id}}" type="button" class="btn btn-primary button_plus" onclick="cart_plus('{{$value->id}}')" style="padding: 0; text-align: center;"><i class="fa fa-plus"></i></button>
                                            <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                                            <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                                            <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                                            <input type="hidden" id="total_brg" value="{{$total_brg}}">
                                    </td>
                                    <td class="align-middle">
                                        <button id="delete_prod" value="{{$value->id}}" type="button" class="btn btn-sm btn-danger" onclick="valDel('{{ $value->id }}');"><i class="fa fa-times" style="color: white;"></i></button>
                                        
                                    </td>
                                </tr>
                                @endforeach
                                @php
                                    $all_brg    = substr($nm_brg, 0, strlen($nm_brg) -1);
                                @endphp
                                <input type="hidden" name="total_pay" id="total_pay" value="{{$total_pay}}">
                                <input type="hidden" id="nm_brg" value="{{$all_brg}}">
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer" id="whatsapp">
                        <button onclick="whatsapp();" class="btn btn-primary btn-block button_order">Pesan Sekarang</button>
                    </div>
                </div>
            </div> -->
        <!-- </div>
        </form> -->
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(document).ready(function() {  
           /*$('#name').on('keyup', function(){ 

                var isi = $(this).val();
                if(isi == ""){
                     $(this).removeClass('data_input');
                    $(this).addClass('data_input_empty');
                }else{
                     $(this).removeClass('data_input_empty');
                    $(this).addClass('data_input');
                }
            });

            $('#deliveryAddress').on('keyup', function(){ 

                var isi = $(this).val();
                if(isi == ""){
                     $(this).removeClass('data_input');
                    $(this).addClass('data_input_empty');
                }else{
                     $(this).removeClass('data_input_empty');
                    $(this).addClass('data_input');
                }
            });

            $('#deliveryCity').on('keyup', function(){ 

                var isi = $(this).val();
                if(isi == ""){
                     $(this).removeClass('data_input');
                    $(this).addClass('data_input_empty');
                }else{
                     $(this).removeClass('data_input_empty');
                    $(this).addClass('data_input');
                }
            });

            $('#phoneNumber').on('keyup', function(){ 

                var isi = $(this).val();
                if(isi == ""){
                     $(this).removeClass('data_input');
                    $(this).addClass('data_input_empty');
                }else{
                     $(this).removeClass('data_input_empty');
                    $(this).addClass('data_input');
                }
            });

            $('#email').on('keyup', function(){ 

                var isi = $(this).val();
                if(isi == ""){
                    $(this).removeClass('data_input');
                    $(this).addClass('data_input_empty');
                }else{
                    $(this).removeClass('data_input_empty');
                    $(this).addClass('data_input');
                }
            });

            $('#kode_promo').on('keyup', function(){ 

                var isi = $(this).val();
                if(isi == ""){
                    $(this).removeClass('data_input');
                    $(this).addClass('data_input_empty');
                }else{
                    $(this).removeClass('data_input_empty');
                    $(this).addClass('data_input');
                }
            });*/
        });

        function whatsapp(){
            var nm      = $('#name').val();
            var kota    = $('#deliveryCity').val(); 
            var almt    = $('#deliveryAddress').val(); 
            var tlp     = $('#phoneNumber').val();
            var email   = $('#email').val();
            var total_brg = $('#total_brg').val();
            var total_pay = $('#total_pay').val();
            var nm_brg    = $('#nm_brg').val();

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

            if(nm!='' && almt!='' && tlp!='' && email!='' && total_brg!=''){
                var href ='Hello Admin Claris,  %0ANama %3A '+nm+', %0AEmail %3A '+email+', %0ANo. Hp %3A' +tlp+', %0AAlamat %3A' +almt+',%0AIngin membeli %3A%0A';

                // window.open('https://api.whatsapp.com/send?phone=+6281776492873&text=*Nama*:%20'+nm+'%0A*Alamat*:%20'+almt+'%0A*Telp*:%20'+tlp+'%0A*Email*:%20'+email+'%0A*Total Item*:%20'+total_brg+'%0A*Total Harga*:%20'+total_pay+'%0A*Pesanan*:%20'+nm_brg);
                window.open('https://api.whatsapp.com/send?phone=+6281776492873&text='+href);
            }else if (nm==''){
                // Swal.fire({ text: 'Silahkan isi Nama terlebih dahulu!', confirmButtonColor: '#4db849'});
                toastMixin.fire({
                    title: 'Silahkan isi Nama terlebih dahulu!',
                    icon: 'error'
                });
            }else if (almt==''){
                // Swal.fire({ text: 'Silahkan isi Alamat terlebih dahulu!', confirmButtonColor: '#4db849'});
                toastMixin.fire({
                    title: 'Silahkan isi Alamat terlebih dahulu!',
                    icon: 'error'
                });
            }else if (tlp==''){
                // Swal.fire({ text: 'Silahkan isi data Telepon terlebih dahulu!', confirmButtonColor: '#4db849'});
                toastMixin.fire({
                    title: 'Silahkan isi data Telepon terlebih dahulu!',
                    icon: 'error'
                });
            }else if (email==''){
                // Swal.fire({ text: 'Silahkan isi data Email terlebih dahulu!', confirmButtonColor: '#4db849'});
                toastMixin.fire({
                    title: 'Silahkan isi data Email terlebih dahulu!',
                    icon: 'error'
                });
            }else if (total_brg==''){
                // Swal.fire({ text: 'Tidak ada barang yang dipesan!', confirmButtonColor: '#4db849'});
                toastMixin.fire({
                    title: 'Tidak ada barang yang dipesan!',
                    icon: 'error'
                });
            }else if (kota==''){
                // Swal.fire({ text: 'Silahkan isi data Kota/Kabupaten terlebih dahulu!', confirmButtonColor: '#4db849'});
                toastMixin.fire({
                    title: 'Silahkan isi data Kota/Kabupaten terlebih dahulu!',
                    icon: 'error'
                });
            }
        }

        function valDel(id){
            Swal.fire({
              title: 'Hapus barang ?',
              text: "Item ini akan di hapus dari keranjangmu",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#4db849',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus',
              cancelButtonText: "Batal"
            }).then((result) => {
              if (result.isConfirmed) {

                $.ajax({
                    type: "GET",
                    url: "{{url('/cart/delete')}}"+'/'+id,
                    data: {id:id},
                    success: function (data) {
                        Swal.fire({
                           title: 'Sukses',
                           text: 'Item ini berhasil di hapus',
                           icon: 'success',
                           showConfirmButton: false,
                           timer: 1500
                       }).then(function(){ 
                        location.reload();
                        });
                    }         
                });
              }
              
            });
        }

        $(function( $ ){

            $('#delete_prod').click(function(){
                var id_prod = $(this).val();

                Swal.fire({
                  title: 'Hapus barang ?',
                  text: "Item ini akan di hapus dari keranjangmu",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#4db849',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Hapus',
                  cancelButtonText: "Batal"
                }).then((result) => {
                  if (result.isConfirmed) {

                    $.ajax({
                        type: "GET",
                        url: "{{url('/cart/delete')}}"+'/'+id_prod,
                        data: {id:id_prod},
                        success: function (data) {
                            Swal.fire({
                               title: 'Sukses',
                               text: 'Item ini berhasil di hapus',
                               icon: 'success'}).then(function(){ 
                            location.reload();
                            });
                        }         
                    });
                  }
                });
            });

            $('#minus').click(function(){
                var id    = $(this).val();
                var mount = $('#'+id).val();
                var total_mount = parseInt(mount) + 1;

                $.ajax({
                  url: '/cart/update_mount?id='+id+'&mount='+total_mount+'&type=min',
                  success : function(data){
                    if (data=='success') {
                      // Swal.fire('success');
                    }
                  }
                });
            });

             $('#plus').click(function(){
                var id    = $(this).val();
                var mount = $('#'+id).val();
                var total_mount = parseInt(mount) - 1;

                $.ajax({
                  url: '/cart/update_mount?id='+id+'&mount='+total_mount+'&type=plus',
                  success : function(data){
                    if (data=='success') {
                      // Swal.fire('success');
                    }
                  }
                });
            });
        });

    </script>
@endsection
