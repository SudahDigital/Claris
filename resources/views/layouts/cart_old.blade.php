@extends('template-cart')
@section('content')
            <div class="container" style="margin-top: 30px;">
                <div class="row align-middle">
                    <div class="col-sm-12 col-md-12">
                        <nav aria-label="breadcrumb" class="">
                            <ol class="breadcrumb px-0 button_breadcrumb">
                                <li class="breadcrumb-item" style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Keranjang Belanja</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- <hr class="mb-5"> -->
                <form method="post" action="{{route('cart_pay')}}"> <!-- method="post" action="{{route('cart_pay')}}" -->
                @csrf
                <div class="row section_content mb-5" style="margin-bottom: 30px">
                    <div class="col-sm-12 col-md-4 col-md-4 mb-5">
                        <div class="card mx-auto cart_card">
                            <div class="card-body">
                                    <div class="form-group">
                                        <input style="border:1px solid #41B1CD" type="text" required="true" name="costumer_name" class="form-control" placeholder="Nama" id="name"required autofocus autocomplete="off">
                                        <!-- <label for="name" class="cart_label">Nama</label> -->
                                    </div>
                                    <div class="form-group">
                                        <textarea style="border:1px solid #41B1CD" class="form-control" required="true"  name="costumer_adress" rows="5" placeholder="Alamat Pengiriman" id="deliveryAddress" required autocomplete="off"></textarea>
                                        <!-- <label for="deliveryAddress" class="cart_label">Alamat Pengiriman</label> -->
                                    </div>  
                                    <div class="form-group">
                                        <input style="border:1px solid #41B1CD" type="number"  name="costumer_phone" required="true" class="form-control" placeholder="Nomor Telepon" id="phoneNumber" required autocomplete="off">
                                        <!-- <label for="phoneNumber" class="cart_label">Nomor Telepon</label> -->
                                    </div>
                                    <div class="form-group">
                                        <input style="border:1px solid #41B1CD" type="email" required="true"  name="costumer_email" class="form-control" placeholder="Email" id="email" required autocomplete="off">
                                        <!-- <label for="email" class="cart_label">Email</label> -->
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 mb-6">
                        <div class="card mx-auto cart_card">
                            <div class="card-body table-responsive">
                                <table class="table text-nowrap" style="width: 100%;">
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
                                            <td class="align-middle img-product" scope="row">
                                                <img src="{{ asset('assets/image/product/'.(($value->image_link!='') ? $value->image_link : 'sleek.jpg').'') }}" class="card-img-top img-fluid">
                                            </td>
                                            <td class="align-middle">
                                                <h5 class="product-name" style="color: #41B1CD !important; font-weight: bold;">{{$value->product_name}}</h5>
                                                <p id="mount3_{{$value->id}}" style="color: #41B1CD !important;">Rp {{ number_format($amount, 0, ',', '.') }}</p>
                                                <div>
                                                    <button id="minus" value="{{$value->id}}" type="button" class="btn btn-primary button_minus" onclick="cart_minus('{{$value->id}}')" style="padding: 0; text-align: center;">-</button>
                                                    <span class="mr-1 ml-1" id="show_m3{{$value->id}}">{{$value->mount}}</span>
                                                    <button id="plus" value="{{$value->id}}" type="button" class="btn btn-primary button_plus" onclick="cart_plus('{{$value->id}}')" style="padding: 0; text-align: center;">+</button>
                                                    <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                                                    <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                                                    <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
                                                    <input type="hidden" id="total_brg" value="{{$total_brg}}">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <!-- <a class="btn btn-sm btn-danger" href="{{route('cart_delete',$value->id)}}" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang belanja Anda?');"><i class="fa fa-times"></i></a> -->
                                                <button id="containner" value="{{$value->id}}" class="btn btn-sm btn-danger"><i class="fa fa-times" style="color: white;"></i></button>
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
                            <!-- <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block button_order">
                                    Pesan Sekarang
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script> -->

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script type="text/javascript">
                function whatsapp(){
                    var nm      = $('#name').val();
                    var almt    = $('#deliveryAddress').val(); 
                    var tlp     = $('#phoneNumber').val();
                    var email   = $('#email').val();
                    var total_brg = $('#total_brg').val();
                    var total_pay = $('#total_pay').val();
                    var nm_brg    = $('#nm_brg').val();

                    if(nm!='' && almt!='' && tlp!='' && email!='' && total_brg!=''){
                        window.open('https://api.whatsapp.com/send?phone=+6281212610009&text=*Nama*:%20'+nm+'%0A*Alamat*:%20'+almt+'%0A*Telp*:%20'+tlp+'%0A*Email*:%20'+email+'%0A*Total Item*:%20'+total_brg+'%0A*Total Harga*:%20'+total_pay+'%0A*Pesanan*:%20'+nm_brg);
                    }else{
                        Swal.fire({ text: 'Silahkan isi data terlebih dahulu!', confirmButtonColor: '#4db849'});
                    }
                }

                $(function( $ ){
                    $('#containner').click(function(){
                        // alert($(this).val());
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
