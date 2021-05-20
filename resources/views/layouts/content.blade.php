@extends('template')
@section('content')
    <!-- <div class="banner">
        <img src="{{ asset('assets/image/6.jpg') }}" style="width:100%;">
        <div class="img-banner"><img src="{{ asset('assets/image/logo_cool.png') }}" style="width: 30%;"></div> -->

        <!-- <div class="txt-banner"> Menjadi ibu rumah tangga yang aktif dan produktif merupakan suatu hal yang positif untuk dibagikan selain menjadi penopang dalam rumah tangga , anda bisa mengisi keseharian anda dengan banyak hal-hal yang positif. Temukan inspirasi-inspirasi menarik seperti mengatur tatanan rumah, memasak dan bermacam-macam hobi yang bisa anda lakukan.</div> -->
    <!-- </div> -->
    <br><br>
    <div role="main" style="margin-top: 4px;">
        <div id="bannerSlide" class="carousel slide" data-ride="carousel" >
            <ul class="carousel-indicators">
                <!-- <li data-target="#bannerSlide" data-slide-to="0" class="active"></li> -->
                <!-- <li data-target="#bannerSlide" data-slide-to="1"></li>
                <li data-target="#bannerSlide" data-slide-to="2"></li> -->
            </ul>
            <div class="carousel-inner">
                <!-- <div class="carousel-item active">
                    <img src="{{ asset('assets/image/banner01.jpg') }}" class="w-100 h-100">
                </div> -->
                <!-- <div class="carousel-item">
                    <img src="{{ asset('assets/image/logo_claris.png') }}" class="w-100 h-100">
                </div> -->
                <!-- <div class="carousel-item">
                    <img src="{{ asset('assets/image/banner-3.jpg') }}" class="w-100">
                </div> -->
                @foreach($banner as $key => $value)
                    <div class="carousel-item {{$value->id == $banner_active ? 'active' : ''}}">
                        <img src="{{ asset('assets/image/banner/'.$value->image_banner)}}" class="w-100 h-100">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#bannerSlide" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#bannerSlide" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>   
    <div class="banner">
        <div class="top-banner"><b>Top Product </b><span class="fa fa-star" style="color: #3CC2B1;"></span></div>
    </div>
    <div class="banner">
        <img src="{{ asset('assets/image/UI Web Claris New-31.png') }}"  style="width:100%; background-color: #fff;">
        <!-- <div class="txt-banner2" style="color: #fff;"> Top Product <span class="fa fa-star" style="color: #fff;"></span></div> -->
    </div>
    <div class="container" style="{{ $page == 'home' ? 'margin-top: 30px' : 'margin-top: 30px' }}">
        <div class="col-12" style="margin-bottom: 20px;">
            <div class="row">
                <div class="col-6 column-left">
                    <h3 class="title-page" style="color: #fff;"><b>Product</b></h3>
                    <!-- <button onclick="getLocation()">Current Location</button> -->
                </div>
                <div class="col-6 column-right">
                    <div class="dropdown">
                        <button class="btn filter_category" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Filter Category</b>
                            <i class="fas fa-caret-down fa-lg"></i>
                        </button>
                        <div class="dropdown-menu font_category" aria-labelledby="dropdownMenuButton" style="height: auto;max-height: 200px;overflow-x: hidden;">
                            <a class="dropdown-item" href="{{ url('/') }}" style="color: #3CC2B1;"><b>Semua Produk</b></a>
                            @foreach($category as $key => $value)
                                <a class="dropdown-item" href="{{route('product_category', ['id'=>$value->id, 'category_name'=>$value->category_name] )}}" style="color: #000;"><b>{{$value->category_name}}</b></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row align-middle" style="{{ $page == 'home' ? 'margin-bottom: 20px' : 'margin-bottom: 10px' }}">
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
        </div> -->
        <div class="row section_content">
            @if(count($product) < 1)
                <h5 class="ml-3">Pencarian tidak ditemukan!</h5>
            @endif
            @foreach($product as $key => $value)
                @if($value->product_stock > 0)
                    <div id="product_list" class="col-6 col-md-6 col-lg-3 mb-4 p-2">
                        <div class="card h-100 item_product" style="border: none; border-radius:20px;">
                           
                            <div id="nmprd" style="background-color: #fff; padding:12px; border-top-right-radius: 20px;border-top-left-radius: 20px; color:#000;">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3 column-left">
                                            <a onclick="detailImg('{{ $value->product_image }}')"><i class="fa fa-eye button_eye" data-toggle="modal" data-target="#ImgModal" style="cursor: pointer;"></i></a>
                                        </div>
                                        <div class="col-9 column-right">
                                            <a onclick="detailDesc('{{ $value->product_description }}')" class="title-dtl" style="font-size: 12px; cursor: pointer;"><span data-toggle="modal" data-target="#exampleModal"><b>Detail Produk</b></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-img-top" style="position: static;">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <div class="embed-responsive-item">
                                        <!-- <a href="{{URL::route('product_detail', ['id'=>$value->id, 'product_name'=>urlencode($value->product_name)])}}"> -->
                                            <img src="{{ asset('assets/image/product/'.(($value->product_image!='') ? $value->product_image : 'none.jpg').'') }}" class="img-fluid img-responsive" alt="...">
                                            <!-- @if($value->product_discount > 0)
                                                <div class="cr cr-bottom cr-right cr-sticky cr-black">{{$value->product_discount}}% OFF</div>
                                            @endif -->
                                        <!-- </a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body view-cart">
                                <div class="p-0" style="background-color: #000 !important;">
                                    <div class="float-left px-1 py-0" style="width: 100%;">
                                        <p class="product-price-header mb-0"><b>{{$value->product_name}}</b></p>
                                    </div>
                                </div>
                                <div class="p-0">
                                    <div class="float-middle px-1 py-0 " style="width: 100%;">
                                        <p class="label-harga mb-0"><strong>Rp {{ number_format($value->product_harga, 0, ',', '.') }},-</strong></p>
                                    </div>
                                </div>
                                <!-- @if($value->product_stock == 0)
                                    <div class="p-1 mb-0 text-dark text-center" style="border-radius:7px;background-color:#e9eff5;"><small><b>Sisa Stok {{$value->product_stock}}</b></small></div>
                                @endif -->
                            </div>

                            <div class="card-body view-color">
                                <!-- <select class="form-control button-color" style="font-size: 12px;" data-show-icon="true">
                                    <?php
                                        $color = explode(",", $value->product_color);
                                        $count_clr = count($color);

                                        for ($i=0; $i < $count_clr; $i++) { 
                                            $hsl = $color[$i];
                                            
                                            echo "<option class=\"text-bold\"><i class=\"fa fa-circle\"></i> $hsl </option>";
                                        }
                                    ?>
                                </select> -->

                                <?php
                                    $color = explode(",", $value->product_color);
                                    $count_clr = count($color);

                                    // $sql = \DB::select("SELECT A.id, B.mount FROM carts AS B LEFT JOIN (SELECT products.id FROM products) AS A ON A.id = B.product_id WHERE B.session_id = '".$user."' AND A.id = '".$value->id."' "); 
                                    // $rst = count($sql);

                                    if($count_clr=="1"){
                                        echo "
                                                <div class=\"col-6 p-1\">
                                                    <div class=\"row mb-0 px-1 input-group\">
                                                        <div class=\"input-group-append\">
                                                            <span class=\"$hsl ic_color\"><i class=\"fa fa-circle fa-lg\" style=\" background-color: #cecece; border-radius: 80px; padding: 2px;></i></span>
                                                            <button class=\"btn button_plus\" onclick=\"button_minus_color('$value->id','$i')\" style=\"padding: 0;color:#000;outline:none;border-bottom-left-radius:7px;border-top-left-radius:7px;\"><i class=\"fa fa-minus fa-xs\" aria-hidden=\"true\"></i></button>
                                                            <input id=\"qty_color_".$value->id."_1\" placeholder=\"0\" class=\"qty-color\" onkeyup=\"qty_number(this.id,this.value)\">
                                                            <button class=\"btn button_plus\" onclick=\"button_plus_color('$value->id','$i')\" style=\"padding: 0;color:#000;outline:none;border-bottom-right-radius:7px;border-top-right-radius:7px;\"><i class=\"fa fa-plus fa-xs\" aria-hidden=\"true\"></i></button>
                                                                <input type=\"hidden\" name=\"ket_color_".$value->id."_1\" id=\"ket_color_".$value->id."_1\" value=\"".$hsl."\">
                                                                <input type=\"hidden\" name=\"count_color_".$value->id."\" id=\"count_color_".$value->id."\" value=\"".$count_clr."\">
                                                        </div>
                                                    </div>
                                                </div>
                                            ";

                                    }else{

                                        echo "<div class=\"row\">";

                                        for ($i=0; $i < $count_clr; $i++) { 
                                            $hsl0 = $color[0];  
                                            $hsl1 = $color[1]; 

                                            echo "<div class=\"col-6 p-1 input-group\">
                                                    <div class=\"input-group-append\"> <!--row-->
                                                        <span class=\"$color[$i] ic_color\"><i class=\"fa fa-circle fa-lg\" style=\" background-color: #cecece; border-radius: 80px; padding: 2px;\"></i></span>
                                                        <button class=\"btn button_plus\" onclick=\"button_minus_color('$value->id','$i')\" style=\"padding: 0; color:#000;outline:none;background-color: #DADADA;border-bottom-left-radius:7px;border-top-left-radius:7px;\"><i class=\"fa fa-minus fa-xs\" aria-hidden=\"true\"></i></button>
                                                        <input id=\"qty_color_".$value->id."_".$i."\" class=\"qty-color\" placeholder=\"0\" onkeyup=\"qty_number(this.id,this.value)\">
                                                        <button class=\"btn button_plus \" onclick=\"button_plus_color('$value->id','$i')\" style=\"padding: 0;color:#000;outline:none;background-color: #DADADA;border-bottom-right-radius:7px;border-top-right-radius:7px;\"><i class=\"fa fa-plus fa-xs\" aria-hidden=\"true\"></i></button>
                                                            <input type=\"hidden\" name=\"ket_color_".$value->id."_".$i."\" id=\"ket_color_".$value->id."_".$i."\" value=\"".$color[$i]."\">
                                                            <input type=\"hidden\" name=\"count_color_".$value->id."\" id=\"count_color_".$value->id."\" value=\"".$count_clr."\">
                                                    </div>
                                                </div>"; 
                                            /*echo "<div class=\"col-6\">
                                                <div class=\"mb-1 box-color\">
                                                    <table width=\"100%\">
                                                        <tbody>
                                                            <tr>
                                                                <td><span class=\"$color[$i] ic_color\"><i class=\"fa fa-circle fa-xs\"></i></span></td>
                                                                <td><button class=\"btn button_plus\" onclick=\"button_minus_color('$value->id','$i')\" style=\"padding: 0; border-radius: 100%; color:#000;outline:none;\"><i class=\"fa fa-minus fa-xs\" aria-hidden=\"true\"></i></button></td>
                                                                <td><input id=\"qty_color_".$value->id."_".$i."\" class=\"qty-color\" placeholder=\"0\" onkeyup=\"qty_number(this.id,this.value)\"></td>
                                                                <td><button class=\"btn button_plus \" onclick=\"button_plus_color('$value->id','$i')\" style=\"padding: 0; border-radius: 100%; color:#000;outline:none;\"><i class=\"fa fa-plus fa-xs\" aria-hidden=\"true\"></i></button>
                                                                    <input type=\"hidden\" name=\"ket_color_".$value->id."_".$i."\" id=\"ket_color_".$value->id."_".$i."\" value=\"".$color[$i]."\">
                                                                    <input type=\"hidden\" name=\"count_color_".$value->id."\" id=\"count_color_".$value->id."\" value=\"".$count_clr."\"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>";*/
                                        }
                                        echo "</div>";
                                    }
                                ?>

                            </div>

                            <div class="button-cart" style="background-color: #fff; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                                <div class="col-12">
                                    <div class="row">
                                        <!-- <div class="col-4"> -->
                                                    @csrf
                                                    <input type="hidden" name="jumlah_clr_{{$value->id}}" id="jumlah_clr_{{$value->id}}" value="{{$count_clr}}">
                                                    <input type="hidden" id="{{$value->id}}" name="jumlah" id="jumlah" value="0">
                                                    <input type="hidden" id="harga_{{$value->id}}" name="harga_{{$value->id}}" value="{{ $value->product_harga }}">
                                                    <input type="hidden" id="product_id_{{$value->id}}" name="product_id_{{$value->id}}" value="{{$value->id}}">
                                                    <input type="hidden" id="prod_img_{{$value->id}}" name="prod_img_{{$value->id}}" value="{{$value->product_image}}">
                                                    <input type="hidden" id="prod_nm_{{$value->id}}" name="prod_nm_{{$value->id}}" value="{{$value->product_name}}">
                                                    <input type="hidden" id="prod_desc_{{$value->id}}" name="prod_desc_{{$value->id}}" value="{{$value->product_description}}">
                                                    <button type="button" class="btn button_tambah btn-lg btn-block" onclick="insertCart('{{ $value->id }}')" style="color: #fff; font-size: 12px;"><b>Tambah</b></button>
                                        <!-- </div> -->
                                        <!-- <div class="col-8">
                                            <div class="float-right text-center">
                                                        <button class="btn button_plus d-inline-display" onclick="button_minus_br('{{$value->id}}')" style="padding: 0; border-radius: 100%; color:#000;outline:none;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                    <?php
                                                        $ses_id = \Request::header('User-Agent');
                                                        $clientIP = \Request::getClientIp(true);
                                                        $user = $ses_id.$clientIP;

                                                        $sql = \DB::select("SELECT A.id, B.mount FROM carts AS B LEFT JOIN (SELECT products.id FROM products) AS A ON A.id = B.product_id WHERE B.session_id = '".$user."' AND A.id = '".$value->id."' "); 
                                                        $rst = count($sql);

                                                        if($rst > 0){
                                                            foreach ($sql as $key => $val_a) {
                                                                echo '<span id="show_'.$val_a->id.'" class="d-inline title-dtl" style="color: #000 !important; border-radius: 5px; padding: 2px; font-weight: bold; text-align: center;">'.$val_a->mount.'</span>';
                                                            }
                                                        }else{
                                                            echo '<span id="show_'.$value->id.'" class="d-inline title-dtl" style="color: #000 !important; border-radius: 5px; padding: 2px; font-weight: bold; text-align: center;">0</span>';
                                                        }
                                                    ?>
                                                        <button class="btn button_plus " onclick="button_plus_br('{{$value->id}}')" style="padding: 0; border-radius: 100%; color:#000;outline:none;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!-- <div class="col-md-12">
            <div class="row justify-content-center" >
                <div class="page" style="margin-top:0; margin-bottom:1rem;">
                    {{ $product }}
                </div>
            </div>
        </div> -->

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
    <footer class="fixed-bottom"> <!--fixed-bottom-->
            <div id="footer"> <!--class="fixed-bottom"-->
                <div class="row" style="background-color: #DADADA; padding: 10px;">
                    <div id="cart_icon" class="col-5 my-auto align-self-center">
                        <?php
                            if(!empty($cart)) {
                                $total = 0;
                                foreach($cart as $key => $value) {
                                    $amount = $value->product_harga * $value->mount;
                                    $total += $amount;
                                }
                        ?>
                            <a href="#" class="float-center cart" style="position: relative;">
                                <img src="{{ asset('assets/image/keranjang.png') }}" alt="" style="width: 30px;">
                                <span id="total_mount" name="total_mount" style="color: #000; font-size: 12px;" class="teks-footer"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></span>
                            </a>
                               
                        <?php
                            } else {
                        ?>
                            <p class="float-center p-0 my-auto" style="color: #000; font-size: 12px;"><strong>Rp 0</strong></p>
                            <a href="{{route('cart')}}" style="position: relative;">
                                <img src="{{ asset('assets/image/keranjang.png') }}" alt="" style="width: 30px;">
                            </a>
                        <?php
                            }
                        ?>
                    </div>
                    <div id="tombol_click" class="col-2 my-auto align-self-center">
                        <a href="#" id="clickme" isi="true" style="color: #000 !important">
                            <i class="fas fa-chevron-up fa-lg"></i>
                        </a>
                    </div>
                    <div class="col-5 my-auto align-self-center" id="sosmed">
                        <a class="float-center cart" style="position: relative;"> <!--href="{{route('cart')}}"-->
                            <span style="color: #000;" class="teks-footer" data-toggle="modal" data-target="#checkoutModal">
                                <img src="{{ asset('assets/image/footer-whatsapp.png') }}" alt="" style="width: 20px;">
                                <strong class="float-center" style="font-size: 12px;">Pesan Sekarang</strong>
                                <!-- <strong class="float-center">( {{$count_cart}} Item )</strong> -->
                            </span>
                        </a>
                    </div>
                </div>
                <div class="hidden row" id="book" style="background-color: #fff; max-height: 250px;">
                    <!-- <div class="scroll w-100 h-100" id="table_c" style="display: none;">
                        @php
                         $total = 0 ;
                        @endphp
                        @foreach($cart as $key => $val_c)
                        @php
                        $amount = $val_c->product_harga * $val_c->mount;
                        $total += $amount;
                        @endphp
                        <div class="row mb-3" style="margin-bottom: 40px; margin-top: 10px;">
                            <div class="col-4">
                                <div class="text-center">
                                    <img class="img-thumbnail img-fluid" src="{{ asset('assets/image/product/'.(($val_c->product_image!='') ? $val_c->product_image : 'none.jpg').'') }}" style="max-width: 90px;max-height: 90px;" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="float-left">
                                    <div class="px-1 py-0">
                                        <p class="product-price-header2 m-0" style="color: #000 !important;"><strong>{{$val_c->product_name}}</strong></p>
                                    </div>
                                    <div class="px-1 py-0">
                                        <p class="label-harga2 m-0" id="mount2_{{$val_c->product_id}}" style="color: #41B1CD !important; font-weight: bold;"><strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong></p>
                                    </div>
                                    <div class="text-left">
                                        <button type="button" class="btn btn-primary button_minus" onclick="cart('{{$val_c->id}}','min')" style="padding: 0; text-align: center; border: none; background-color: #fff; color: #000; border-radius: 50px;"><i class="fa fa-minus"></i></button>
                                        <span class="product-name mr-1 ml-1" id="show_m2{{$val_c->product_id}}" style="color: #000; padding: 3px; font-weight: bold;"> {{$val_c->mount}} </span>
                                        <button type="button" class="btn btn-primary button_plus" onclick="cart('{{$val_c->id}}','plus')" style="padding: 0; text-align: center; border: none; background-color: #fff; color: #000; border-radius: 50px;"><i class="fa fa-plus"></i></button>
                                        <input type="hidden" id="{{$val_c->id}}" value="{{$val_c->mount}}">
                                        <input type="hidden" id="harga_m{{$val_c->id}}" value="{{$amount}}">
                                        <input type="hidden" id="harga{{$val_c->id}}" value="{{$val_c->product_harga}}">
                                        <input type="hidden" id="product_id_{{$val_c->id}}" value="{{$val_c->product_id}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 align-self-center">
                                <button class="btn btn-sm btn-danger" onclick="valDel('{{$val_c->id}}')" style="border-radius: 10px;"><i class="fa fa-times" style="color: white;"></i></button>
                            </div>
                        </div>
                        @endforeach
                    </div> -->
                    <div class="scroll w-100 h-100" id="table_c" style="display: none;">
                    </div>
                </div>
                <div id="listcart" class="col-12 my-auto text-right" style="background-color: #fff; height: 50px; display: none;">
                        <a class="btn btn-sm align-self-right button_pesan" style="background-color: #25d366; color: #fff; border-radius: 30px;" data-toggle="modal" data-target="#checkoutModal"> <!--href="{{route('cart')}}"-->
                        <input type="hidden" id="total" value="{{$total}}">
                        <img src="{{ asset('assets/image/logo-whatsapp.png') }}" style="width: 20px;"> Pesan Sekarang
                        </a>  
                </div>
            </div>
            <div id="bottom-footer text-center" class="bottom-footer">
                <div class="col-12 row">
                    <div class="col-6">    
                        <div class=" text-center py-2">
                            <img class="logo-claris" src="{{ asset('assets/image/logo_claris.png') }}" width="80px" height="40px">
                            <div class="text-center teks-footer">
                                <span class="footer_text" style="color: #000; font-size: 12px;"><b>© Copyright 2020</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">    
                        <div class="row text-center py-4">
                            <div class="col-12 my-auto mx-auto">
                                <span style="color: #000; font-size: 12px;" class="footer_text"><b>Follow Us&nbsp;&nbsp;&nbsp;</b></span>
                                <a href="https://www.facebook.com/" class="mr-1 mr-md-3">
                                    <img src="{{ asset('assets/image/UI Web Claris New-20.png') }}" alt="" class="img-icon" style="width: 20px;">
                                </a>
                                <a href="https://twitter.com/" class="mr-1 mr-md-3">
                                    <img src="{{ asset('assets/image/UI Web Claris New-21.png') }}" alt="" class="img-icon" style="width: 20px;">
                                </a>
                                <a href="https://www.youtube.com/" class="mr-1 mr-md-3">
                                    <img src="{{ asset('assets/image/UI Web Claris New-22.png') }}" alt="" class="img-icon" style="width: 20px;">
                                <a href="https://www.instagram.com/" class="mr-1 mr-md-3">
                                    <img src="{{ asset('assets/image/UI Web Claris New-23.png') }}" alt="" class="img-icon" style="width: 20px;">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="footer-copyright text-center py-3" style="background-color: #000">© 2020 Copyright:
                <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
            </div> -->
        </footer>

    <div class="modal fade" id="ImgModal" role="dialog" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #fff">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <img class="dtl_img">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel"><b>Deskripsi Produk<b></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="detail_desc" style="color: #0097bb;"></p>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <img src="{{ asset('assets/image/logo_claris.png') }}" style="width: 50px;">
            <h6 class="modal-title" id="checkoutModalLabel"><b>Konfirmasi Pesanan<b></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body bck-cust" style="background: #0097BB; font-size: 12px;">
            <form method="post" action="{{route('cart_pay')}}" class="form-horizontal">
                @csrf
                <div class="card-body view-pesanwa section_content">
                  <!-- <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label" style="color: #fff;"><b>Nama</b></label>
                    <div class="col-sm-9">
                      <input style=" border-radius: 20px;" type="text" name="costumer_name" class="form-control" id="name">
                    </div>
                  </div> -->
                  <div class="form-group row">
                    <label for="phoneNumber" class="col-sm-3 col-form-label" style="color: #fff;"><b>No. Telp/ Handphone<b/></label>
                    <div class="col-sm-9">
                      <input style=" border-radius: 20px;" type="number"  name="costumer_phone" class="form-control input-cust" id="costumer_phone" maxlength="12" value="{{$cust_order_telp}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="deliveryCity" class="col-sm-3 col-form-label" style="color: #fff;"><b>Kabupaten/Kota</b></label>
                    <div class="col-sm-9">
                      <!-- <input style=" border-radius: 20px;" class="form-control"  name="costumer_city" id="deliveryCity"> -->
                      <select id="city_name" name="city_name" class="form-control select2 input-cust" style="width: 100%; border-radius: 20px;">
                        <option value="">--</option>
                        @foreach($cities as $key => $value)
                            <option id="city_name" value="{{$value->city_name}}" <?php if($cust_order_city == $value->city_name) echo "selected";?>>{{$value->city_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="deliveryAddress" class="col-sm-3 col-form-label" style="color: #fff;"><b>Detail Alamat</b></label>
                    <div class="col-sm-9">
                      <textarea style=" border-radius: 20px;" class="form-control input-cust"  name="costumer_adress" id="deliveryAddress" rows="2">{{ $cust_order_address }}</textarea>
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label" style="color: #fff;"><b>Email</b></label>
                    <div class="col-sm-9">
                      <input style="border-radius: 20px;" type="email"  name="costumer_email" class="form-control" id="email" >
                    </div>
                  </div> -->
                  <div class="form-group row">
                    <label for="kode_promo" class="col-sm-3 col-form-label" style="color: #fff;"><b>Code Promo</b></label>
                    <div class="col-sm-9 input-group">
                        <div class="input-group-append">
                            <input style=" border-bottom-left-radius: 20px; border-top-left-radius: 20px;" class="form-control col-5 input-cust"  name="kode_promo" id="kode_promo"></input>
                            <span class="btn" onclick="validasiVouchers();" style="background-color: #CECECE !important; border: none;color: #000;border-bottom-right-radius:20px;border-top-right-radius:20px; font-size: 12px;"><strong>Terapkan</strong></span>
                            <span class="icon-promo" style="color: #fff;"></span>
                            <input type="hidden" name="verfikasi" id="verfikasi">
                        </div>
                    </div>
                  </div>
                  <div class="form-group form-syarat">
                    <label style="color: #fff;"><b>Syarat dan ketentuan belanja dengan Whatsapp Delivery Claris :</b></label>
                    <textarea style=" border-radius: 30px; font-weight: bold; font-size: 12px;" class="form-control"  name="costumer_adress" id="deliveryAddress" rows="8" disabled>1. Jam operasional order mulai pukul 08.00 – 16.00 WIB (Senin – Jumat).
2. Batas pemesanan order untuk penggirman hari yang sama yaitu pukul 12.00 WIB, jika order lewat pukul 12.00 akan dikirim pada hari berikutnya atau mengikuti waktu operasional.
3. Sebelum pengiriman, admin akan menginformasikan total belanja diluar ongkos kirim.
4. Masukan kode promo jika ada.
5. Penggiriman produk akan dilakukan setelah admin verfikasi pembayaran.
6. Pembayaran dilakukan system transfer ke nomor rekening yang telah ditentukan.
                    </textarea>
                    <!-- <label for="phoneNumber" class="cart_label">Nomor Telepon</label> -->
                  </div>
                  <div class="text-center" style="float: center;">
                    <button id="savecookie" class="btn button_whatsapp" type="submit" onclick="pesan_wa();">
                        <img src="{{ asset('assets/image/logo-whatsapp.png') }}" alt="" style="width: 20px; font-size: 12px;">
                        <strong class="float-center" style="font-size: 15px;color: #fff;">Pesan Sekarang</strong>
                    </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="cekInsert" tabindex="-1" role="dialog" aria-labelledby="cekInsertLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="cekInsertLabel"><b>Tambah Barang<b></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card card-solid" style="border: none;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="col-12">
                        <div class="row justify-content-center">
                            <img class="dtl_img2">
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <h3><b><p class="detail_nm2" style="color: #0097bb;"></p></b></h3>
                      <h6 class="my-3"><b><p class="detail_desc2"></p></b></h6>
                      <h4 class="mb-0">
                        <b><p class="detail_harga2"></p></b>
                      </h4>
                      <hr>
                      <h6><b>Available Colors</b></h6>
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">

                        <select class="form-control select2" style="width: 100%;">
                            <option value="">--</option>
                            <option>Biru</option>
                            <option>Hijau</option>
                            <option>Pink</option>
                          </select>
                      </div>
                      <div class="mt-4">
                        <div class="btn button_filter btn-lg btn-flat" style="color: #fff;">
                          <i class="fas fa-cart-plus fa-lg mr-2"></i>
                          Add to Cart
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {  
            $( "#clickme" ).click(function() {
                $('#table_c').load("{{url('/cart/footer-list')}}");

                var isi = $("#clickme").attr('isi');
                $( "#book" ).slideDown( "slow", function() {
                    if (isi=='true') {
                        $('#tombol_click').removeClass();
                        $('#tombol_click').addClass('col-2 my-auto');
                        $('#table_c').css({'display':'block'});
                        $('.proses_to_chart_slide').css({'display':'block'});
                        $('#listcart').show();
                        $('#clickme').html('<i class="fas fa-chevron-down fa-lg"></i>');
                        $('#clickme').attr('isi','false');
                        // $('#cart_icon').css({'display':'none'})
                        // $('#sosmed').css({'display':'none'})
                        $('.hidden').toggleClass('open');
                        $('#bottom-footer').css({'display':'none'});
                    }else{
                        $('#tombol_click').removeClass();
                        $('#tombol_click').addClass('col-2 my-auto');
                        $('.proses_to_chart_slide').css({'display':'none'});
                        $('#listcart').hide();
                        $('#clickme').html('<i class="fas fa-chevron-up fa-lg"></i>');
                        $('#clickme').attr('isi','true');
                        // $('#cart_icon').css({'display':'block'})
                        // $('#sosmed').css({'display':'block'})
                        $('.hidden').toggleClass('open');
                        $('#table_c').css({'display':'none'});
                        $('#bottom-footer').css({'display':'block'});
                    }
                });
            });

            $( ".filter_category" ).click(function() {
                // alert('jalan');
            });

            $( "#savecookie" ).click(function() {
                // $.cookie('telp', $("#costumer_phone").val());
                // $.cookie('alamat', $("#costumer_adress").val());

                // setCookie('telp', $("#costumer_phone").val());
                // setCookie('alamat', $("#costumer_adress").val());
                // return true;

                // alert($.cookie("telp"));
            });
        });
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

            if (jumlah<0) {
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
              $('#show_m2'+id).html(jumlah);
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

              $('#'+id).val(jumlah);
              $('#show_'+id).html(jumlah);
              $('#show_m2'+id).html(jumlah);
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

        function detailImg(img){
            $('#ImgModal').show();
            if(img!=""){
                $(".dtl_img").attr("src","{{ asset('assets/image/product/') }}"+'/'+img);
            }else{
                $(".dtl_img").attr("src","{{ asset('assets/image/product/none.jpg') }}");
            }
        }

        function detailDesc(desc){
            $(".detail_desc").html(desc);
        }

        function insertCart(id){
            var product     = $('#product_id_'+id).val();
            var mount       = $('#'+id).val();
            var price       = $('#harga_'+id).val();
            var mount_cart  = $('#show_'+id).html();

            var jumlah_clr  = $('#jumlah_clr_'+id).val();

            var qtyarr = [];

            if(jumlah_clr>1){
                for(var i=0; i<jumlah_clr; i++){
                    var qty     = $('#qty_color_'+id+'_'+i).val();
                    var color   = $('#ket_color_'+id+'_'+i).val();

                    qtyarr.push(color+'_'+qty);
                }
            }else{
                var qty     = $('#qty_color_'+id+'_1').val();
                var color   = $('#ket_color_'+id+'_1').val();

                qtyarr.push(color+'_'+qty);
            }

            $.ajax({
                url: '/cart/update_cart?id='+id+'&product_id='+id+'&jumlah='+mount,
                data:{
                        id : id,
                        product_id : product,
                        jumlah : mount,
                        jumlah_clr : jumlah_clr,
                        qty : qtyarr
                    }, 
                success : function(data){
                    if (data['status']=='success') {

                        var total_price = parseFloat(data['total_price']);
                        var prc = (total_price/1000).toFixed(3);
                        var prc2 = rupiah(data['total_price']);
                        $('#total_mount').html('<strong>'+prc2+'</strong>');

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

        function cekInsert(id){
            var prod_img    = $('#prod_img_'+id).val();
            var prod_nm     = $('#prod_nm_'+id).val();
            var prod_desc   = $('#prod_desc_'+id).val();
            var harga       = rupiah($('#harga_'+id).val());

            // alert(prod_img+'_'+prod_nm+'_'+prod_desc);
            $(".dtl_img2").attr("src","{{ asset('assets/image/product/') }}"+'/'+prod_img);
            $(".detail_nm2").html(prod_nm);
            $(".detail_desc2").html(prod_desc);
            $(".detail_harga2").html(harga+',-');
        }

        function cart(id,param)
        {
          var harga_mount = $('#harga_m'+id).val();
          var harga = $('#harga'+id).val();
          var total = $('#total').val();
          var mount = $('#'+id).val();
          var id_prod = $('#product_id_'+id).val();
          var mount_plus = parseInt(mount)+1;
          var mount_min  = parseInt(mount)-1;

          if(param=='plus'){
            $.ajax({
              url: '/cart/update_mount?id='+id+'&mount='+mount+'&type='+param,
              success : function(data){
                if (data=='success') {
                  $('#table_c').load("{{url('/cart/footer-list')}}");

                  var mount1 = parseInt(mount)+1;
                  var harga_mount1 = parseInt(harga_mount) + parseInt(harga);
                  harga_mount2 = rupiah(harga_mount1);

                  $('#show_m2'+id_prod).html(mount1);
                  $('#show_'+id_prod).html(mount1);
                  $('#'+id).val(mount1);

                  $('#harga_m'+id).val(harga_mount1);
                  $('#mount2_'+id_prod).html(harga_mount2);
                  var total1 = parseInt(total)+ parseInt(harga);

                  $('#total').val(total1);
                  var total2 = rupiah(total1);
                  $('#total_').html(total2);

                  var hrg = $('#tot_hrg').val();
                  var hrg2 = parseInt(hrg) + parseInt(harga);
                  var hrg3 = rupiah(hrg2);

                  $('#total_mount').html('<strong>'+hrg3+'</strong>');
                }
              }
            })
          }

          if(param=='min'){
            if(mount_min!='0'){
              $.ajax({
                url: '/cart/update_mount?id='+id+'&mount='+mount+'&type='+param,
                success : function(data){
                  if (data=='success') {
                    $('#table_c').load("{{url('/cart/footer-list')}}");

                    var mount1 = parseInt(mount)-1;
                    var harga_mount1 = parseInt(harga_mount) - parseInt(harga);
                    harga_mount2 = rupiah(harga_mount1);
                    
                    $('#show_m2'+id_prod).html(mount1);
                    $('#show_'+id_prod).html(mount1);
                    $('#'+id).val(mount1);

                    $('#harga_m'+id).val(harga_mount1);
                    $('#mount2_'+id_prod).html(harga_mount2);
                    var total1 = parseInt(total)- parseInt(harga);

                    $('#total').val(total1);
                    var total2 = rupiah(total1);
                    $('#total_').html(total2);

                    var hrg = $('#tot_hrg').val();
                    var hrg2 = parseInt(hrg) - parseInt(harga);
                    var hrg3 = rupiah(hrg2);

                    $('#total_mount').html('<strong>'+hrg3+'</strong>');
                  }
                }
              })
            }
          }
        }

        function button_minus_color(id,seq){
            var qty     = $('#qty_color_'+id+'_'+seq).val();
            if(qty==''){qty = "0";}
            var mount   = parseInt(qty)-1;
            $('#qty_color_'+id+'_'+seq).val(mount);
        }

        function button_plus_color(id,seq){

            var qty     = $('#qty_color_'+id+'_'+seq).val();
            if(qty==''){qty = "0";}
            var mount   = parseInt(qty)+1;
            $('#qty_color_'+id+'_'+seq).val(mount);
        }

        function qty_number(id,value){
            var str = value;
            var set = str.replace(/[^0-9.]/g,"");
            var hasil = $('#'+id).val(set);
            return hasil;

        }

        function pesan_wa() {

            Swal.fire({
            title: 'Memesan',
            text: "Anda melakukan pesanan melalui whatsapp",
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: "Ok",
            confirmButtonColor: '#4db849'
            }).then(function(){ 
                location.reload();
            });
        }

        function validasiVouchers() {
            var kode_promo = $('#kode_promo').val();

            $.ajax({
                url: '/cart/check_vouchers?voucher='+kode_promo,
                success : function(data){
                  if (data['status']=='success') {
                        Swal.fire({
                        text: data['validasi'],
                        icon: 'info',
                        showCancelButton: false,
                        confirmButtonText: "Ok",
                        confirmButtonColor: '#4db849'
                        }); 

                        if(data['validasi'] == '' || data['validasi'] == 'Promo Expired!'){
                            $('.icon-promo').html('');
                            $('#kode_promo').val('');
                            $('#verfikasi').val('expired');
                        }else{
                            $('.icon-promo').html('<i class="fas fa-check-circle fa-lg"></i>');
                            $('#verfikasi').val('success');
                        }
                  }
                }
              })
            
        }

        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          }
        }

        function showPosition(position) {
            alert("Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude);

            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // var latlng = new google.maps.LatLng(lat, lng);
            // var geocoder = geocoder = new google.maps.Geocoder();
            // geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            //     if (status == google.maps.GeocoderStatus.OK) {
            //         if (results[1]) {
            //             alert("Location: " + results[1].formatted_address);
            //         }
            //     }
            // });

          // window.open('http://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&sensor=false&key=AIzaSyB91xF1eApIPDQccEYjXKA6Q4tKB8vV35s');
        }


    </script>
@endsection
