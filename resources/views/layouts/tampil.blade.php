@csrf

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
            <div class="text-left">
                <span class="product-price-header2 m-0" style="color: #000 !important;"><strong>{{$val_c->product_name}}</strong></span>
            </div>
            <div class="text-left">
                <span class="label-harga2 m-0" id="mount2_{{$val_c->product_id}}" ><strong>Rp {{ number_format($val_c->total, 0, ',', '.') }}</strong></span>
            </div>
            <div class="text-left">
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
    <div class="col-2 align-self-center">
        <button class="btn btn-sm btn-danger" onclick="valDel('{{$val_c->id}}','{{$val_c->product_id}}')" style="border-radius: 10px;"><i class="fa fa-times" style="color: white;"></i></button>
    </div>
</div>
@endforeach
<input type="hidden" id="tot_hrg" value="{{$total}}">