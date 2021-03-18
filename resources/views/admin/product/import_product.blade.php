@extends('admin.master')
@section('title') Product List @endsection
@section('title2') Manage Product @endsection
@section('content')

<section class="content">
	<form method="post" enctype="multipart/form-data" action="{{route('import_data_produk')}}">
    	@csrf
        
        <div class="row section_content mb-5" style="margin-bottom: 30px">
	        <div class="col-md-12">
	            <div class="card mx-auto cart_card">
	            	<div class="card-header">
	                    <h3 class="card-title"><b>Upload Data <small class="text-muted">Ext (.xls, .xlsx)</small></b></h3>
	                </div>
	                <div class="card-body col-md-12 row">
				        <div class="form-group">
				            <div class="input-group">
				                <div class="custom-file">
				                    <input type="file" id="upl_file" name="upl_file" autocomplete="off">
				                </div>
				            </div>
				        </div>
				    </div>
	                <div class="card-footer text-right">
	                    <button type="submit" value="IMPORT" class="btn btn-primary">Submit</button>
	                    <a class="btn btn-warning" href="{{URL::previous()}}">Cancel</a>
	                </div>
	            </div>
	        </div>
	    </div>
    </form>
</section>

@endsection