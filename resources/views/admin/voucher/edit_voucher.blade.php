@extends('admin.master')
@section('title') Voucher List @endsection
@section('title2') Manage Voucher @endsection
@section('content')

<section class="content">
   <form method="post" action="{{route('edit_voucher')}}">
        @csrf
        <div class="row section_content mb-5" style="margin-bottom: 30px">
            <div class="col-md-12">
                <div class="card mx-auto cart_card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Form Input</h3>
                    </div> -->
                    <div class="card-body col-md-12 row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="produk_nama">Voucher Code <span style="color: red;">*</span></label>
                                <input type="text" required="true" name="code_voucher" class="form-control" id="code_voucher" value="{{ $code }}" required autofocus autocomplete="off" disabled="true">
                                <input type="hidden" name="id" value="{{ $id }}">
                            </div>
                            <div class="form-group">
                                <label for="produk_nama">Voucher Name <span style="color: red;">*</span></label>
                                <input type="text" required="true" name="name_voucher" class="form-control" id="name_voucher" value="{{ $name }}" required autofocus autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="produk_nama">Voucher Description <span style="color: red;">*</span></label>
                                <textarea type="text" name="desc_voucher" class="form-control" id="desc_voucher" cols="10" rows="5" required>{{ $description }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="produk_nama">Voucher Type <span style="color: red;">*</span></label>
                                <div class="custom-control custom-radio">
                                  <input class="custom-control-input" type="radio" id="percentage" name="type" value="1" <?php if($type=='1') echo "checked"; ?>>
                                  <label for="percentage" class="custom-control-label">Percentage (%)</label>
                                </div>
                                <div class="custom-control custom-radio">
                                  <input class="custom-control-input" type="radio" id="flat" name="type" value="2" <?php if($type=='2') echo "checked"; ?>>
                                  <label for="flat" class="custom-control-label">Flat</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="produk_nama">Amount <span style="color: red;">*</span></label>
                                <input type="text" required="true" name="amount_voucher" class="form-control" id="amount_voucher" value="{{ $discount_amount }}" required autofocus autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="produk_nama">Expired Date Voucher <span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="exp_date" name="exp_date" placeholder="dd/mm/yyyy" class="form-control date" value="{{ $expires_at }}" required>
                                    <div class="input-group-append">
                                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="produk_nama">Maximum Voucher Usage <span style="color: red;">*</span></label>
                                <input type="number" required="true" name="max_use" class="form-control" id="max_use" value="{{ $max_uses }}" required autofocus autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-warning" href="{{ route('dash_voucher') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<script src="{{ asset('assets_admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- <script src="{{ asset('assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
<script src="{{ asset('assets_admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets_admin/dist/js/demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('assets_admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        //
    });
    $('.date').datepicker({  
       format: 'dd/mm/yyyy'
    });  
</script>
<script src="{{ asset('assets_admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
</body>
</html>

@endsection
