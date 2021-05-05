@csrf

@php
 $total = 0 ;
@endphp
@foreach($cart as $key => $val_c)
@php
$amount = $val_c->product_harga * $val_c->mount;
$total += $amount;
@endphp
<div class="row mb-3" style="margin-bottom: 40px; margin-top: 10px; margin-left: 10px; margin-right: 10px;">
    <div class="col-3 card" style="border:none;">
        <div class="text-center card-img-top">
            <img class="img-thumbnail img-fluid" src="{{ asset('assets/image/product/'.(($val_c->product_image!='') ? $val_c->product_image : 'none.jpg').'') }}" style="max-width: 90px;max-height: 90px;" class="img-fluid">
        </div>
        <!-- <div class="card-body p-0" style="align-self: center;">
            <div class="p-0" style="background-color: #000 !important;">
                <div class="float-left px-1 py-0" style="width: 100%;">
                    <p class="product-price-header2 m-0"><b>{{$val_c->product_name}}</b></p>
                </div>
            </div>
            <div class="p-0">
                <div class="float-middle px-1 py-0 " style="width: 100%;">
                    <p class="label-harga2 m-0"><strong>Rp {{ number_format($val_c->total, 0, ',', '.') }},-</strong></p>
                </div>
            </div>
        </div> -->
    </div>
    <div class="col-3">
        <div class="float-left">
            <div class="text-left">
                <div class="p-0" style="align-self: center;">
                    <div class="p-0" style="background-color: #000 !important;">
                        <div class="float-left px-1 py-0" style="width: 100%;">
                            <p class="product-price-header2 m-0"><b>{{$val_c->product_name}}</b></p>
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="float-middle px-1 py-0 " style="width: 100%;">
                            <p class="label-harga2 m-0"><strong>Rp {{ number_format($val_c->total, 0, ',', '.') }},-</strong></p>
                        </div>
                    </div>
                </div>
                <!-- <button type="button" class="btn btn-primary button_minus" onclick="cart('{{$val_c->id}}','min')" style="padding: 0; text-align: center; border: none; background-color: #fff; color: #000; border-radius: 50px;"><i class="fa fa-minus"></i></button>
                <span class="product-name mr-1 ml-1" id="show_m2{{$val_c->product_id}}" style="color: #000; padding: 3px; font-weight: bold;"> {{$val_c->mount}} </span>
                <button type="button" class="btn btn-primary button_plus" onclick="cart('{{$val_c->id}}','plus')" style="padding: 0; text-align: center; border: none; background-color: #fff; color: #000; border-radius: 50px;"><i class="fa fa-plus"></i></button> -->
                <input type="hidden" id="{{$val_c->id}}" value="{{$val_c->mount}}">
                <input type="hidden" id="harga_m{{$val_c->id}}" value="{{$amount}}">
                <input type="hidden" id="harga{{$val_c->id}}" value="{{$val_c->product_harga}}">
                <input type="hidden" id="product_id_{{$val_c->id}}" value="{{$val_c->product_id}}">
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="float-left">
            <div class="text-left">
                <p style="font-size: 12px;"><strong>QTY:</strong></p>
                <?php
                    $sql = \DB::select("SELECT a.* FROM carts a WHERE a.session_id = '".$val_c->session_id."' and a.product_id = '".$val_c->product_id."'"); 
                    $rst = count($sql);
                    foreach ($sql as $key => $val) {
                        echo "<div class=\"row mb-0 px-1 input-group\">
                                    <div class=\"input-group-append\">
                                        <span class=\"$val->color ic_color\"><i class=\"fa fa-circle fa-xs\"></i></span>
                                        <button class=\"btn button_plus\" onclick=\"button_minus_color2('$val->product_id','$key')\" style=\"padding: 0;border-bottom-left-radius:7px;border-top-left-radius:7px; color:#000;outline:none;\"><i class=\"fa fa-minus fa-xs\" aria-hidden=\"true\"></i></button>
                                        <input id=\"qty2_color_".$val->product_id."_".$key."\" placeholder=\"0\" class=\"qty-color\" onkeyup=\"qty_number(this.id,this.value)\" value=\"".$val->mount."\">
                                        <button class=\"btn button_plus\" onclick=\"button_plus_color2('$val->product_id','$key')\" style=\"padding: 0; border-bottom-right-radius:7px;border-top-right-radius:7px; color:#000;outline:none;\"><i class=\"fa fa-plus fa-xs\" aria-hidden=\"true\"></i></button>
                                        <input type=\"hidden\" name=\"ket2_color_".$val->product_id."_".$key."\" id=\"ket2_color_".$val->product_id."_".$key."\" value=\"".$val->color."\">
                                        <input type=\"hidden\" name=\"count_color_".$val->product_id."\" id=\"count_color_".$val->product_id."\" value=\"\">
                                    </div>
                                </div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col-2 align-self-center">
        <button class="btn btn-sm btn-danger" onclick="valDel('{{$val_c->id}}','{{$val_c->product_id}}')" style="border-radius: 10px;"><i class="fa fa-times" style="color: white;"></i></button>
    </div>
</div>
@endforeach
<input type="hidden" id="tot_hrg" value="{{$total}}">