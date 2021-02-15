@csrf

@php
$total = 0 ;
@endphp
@foreach($cart as $key => $value)
@php
$amount = $value->product_harga * $value->mount;
$total += $amount;
@endphp
<div class="row">
    <div class="col-4">
        <div class="float-left">
            <img class="img-thumbnail img-fluid" src="{{ asset('assets/image/product/'.(($value->product_image!='') ? $value->product_image : 'none.jpg').'') }}" style="max-width: 100px;max-height: 100px;" class="img-fluid">
        </div>
    </div>
    <div class="col-6">
        <div class="float-left">
            <h5 class="product-name" style="color: #4db849 !important; font-weight: bold;">{{$value->product_name}}</h5>
            <span id="mount2_{{$value->id}}" style="color: #000 !important;">Rp {{ number_format($amount, 0, ',', '.') }}</span>
            <div class="text-left">
                <button type="button" class="btn btn-success button_minus" onclick="cart('{{$value->id}}','min')" style="padding: 0; text-align: center;">-</button>
                <span class="mr-1 ml-1" id="show_m2{{$value->id}}"> {{$value->mount}} </span>
                <button type="button" class="btn btn-success button_plus" onclick="cart('{{$value->id}}','plus')" style="padding: 0; text-align: center;">+</button>
                <input type="hidden" id="{{$value->id}}" value="{{$value->mount}}">
                <input type="hidden" id="harga_m{{$value->id}}" value="{{$amount}}">
                <input type="hidden" id="harga{{$value->id}}" value="{{$value->product_harga}}">
            </div>
        </div>
    </div>
    <div class="col-2">
        <a class="btn btn-sm btn-danger" onclick="valDel('{{$value->id}}')"><i class="fa fa-times" style="color: white;"></i></a>
    </div>
</div>
@endforeach
<div class="row">
    <div class="col-12">
        <div class="float-left">
            <span style="background: #ffffff;font-size: 250%">&nbsp;</span>
        </div>
    </div>
</div>