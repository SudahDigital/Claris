@extends('template-nocart')
@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li  style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li  aria-current="page"> &nbsp; | Kontak Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 mb-5">
                <!-- <form>
                    <div class="card mx-auto contact_card">
                        <div class="card-body"> -->
                            <!-- <div class="form-group">
                                <input style="border:1px solid #4CD31E" type="text" class="form-control" placeholder="Nama" id="name "required autofocus autocomplete="off"> -->
                                <!-- <label for="name" class="contact_label">Nama</label> -->
                            <!-- </div>
                            <div class="form-group">
                                <input style="border:1px solid #4CD31E" type="email" class="form-control" placeholder="Email" id="email" required autocomplete="off"> -->
                                <!-- <label for="email" class="contact_label">Email</label> -->
                            <!-- </div>
                            <div class="form-group">
                                <input style="border:1px solid #4CD31E" type="text" class="form-control" placeholder="Subject" id="subject" required autocomplete="off"> -->
                                <!-- <label for="subject" class="contact_label">Subjek</label> -->
                            <!-- </div>
                            <div class="form-group">
                                <textarea style="border:1px solid #4CD31E" class="form-control" rows="5" placeholder="Pesan" id="message" required autocomplete="off"></textarea> -->
                                <!-- <label for="message" class="contact_label">Pesan</label> -->
                            <!-- </div>  --> 
                            <!-- <a class="btn btn-block btn-outline-success"><i class="fa fa-envelope"></i>&nbsp;Email</a>
                            <a class="btn btn-block btn-outline-success"><i class="fa fa-phone"></i>&nbsp;Telepon</a> -->
                        <!-- </div>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-block btn-success button_send">Kirim</button>
                    </div>
                </form> -->
                <div class="row section_content">
                    <div class="col-sm-12 col-md-6 mb-5">
                        <div class="card" style="background-color: #ffffff; border-radius: 25px; border: none;">
                            <div class="row card-body">
                                <div class="col-12 col-md-4 float-left my-auto d-none d-md-inline-block text-right">
                                    <img src="{{ asset('assets/image/contact_phone.png') }}" class="card-img-top" alt="...">
                                </div>
                                <div class="col-12 col-md-8 float-right my-auto text-center" style="color: #000;">
                                    <a class="card-img-top d-md-none d-inline-block"><img src="{{ asset('assets/image/contact_phone.png') }}" class="card-img-top" alt="..." style="height: 50px; width: 50px;"></a>
                                    <h5 class="card-title" style="font-size: 30px; color: #F77C22; font-weight: bold;">Telepon</h5>
                                    <h5 class="card-title" style="font-size: 20px">{{$telp}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-5">
                        <div class="card" style="background-color: #ffffff; border-radius: 25px; border: none;">
                            <div class="row card-body">
                                <div class="col-12 col-md-4 float-left my-auto d-none d-md-inline-block text-center">
                                    <img src="{{ asset('assets/image/contact_email.png') }}" class="card-img-top" alt="...">
                                </div>
                                <div class="col-12 col-md-8 float-right my-auto text-center">
                                    <a class="card-img-top d-md-none d-inline-block"><img src="{{ asset('assets/image/contact_email.png') }}" class="card-img-top" alt="..." style="height: 50px; width: 50px;"></a>
                                    <h5 class="card-title" style="font-size: 30px; color: #C13EB7; font-weight: bold;">Email</h5>
                                    <h5 class="card-title" style="font-size: 20px;">{{$email}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
@endsection
