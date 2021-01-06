<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\BannerImage;

class DashBannerController extends Controller
{
    public function index(Request $request)
    {
        $sql = "select * from banner_images";
    	$banner = DB::select($sql);

        $data['banner'] = $banner;

        return view ('admin.banner.list_banner', $data);
    }

    public function add()
    {
        return view ('admin.banner.create_banner');   
    }

    public function create(Request $request)
    {
		if(isset($_FILES['upl_image'])){
    		$errors= array();
	      	$file_name = $_FILES['upl_image']['name'];
	      	$file_size = $_FILES['upl_image']['size'];
	      	$file_tmp = $_FILES['upl_image']['tmp_name'];
	      	$file_type = $_FILES['upl_image']['type'];
		      
		    if($file_size > 2097152) {
		        $errors[]='File size must be excately 2 MB';
		    }

		    if(empty($errors)==true){
			    if(move_uploaded_file($file_tmp,"assets/image/banner/".$file_name)) {

		  			$banner = "INSERT INTO banner_images (
		  							image_banner,
		  							created_at
		  						) VALUES (
		  							'".$file_name."',
		  							now()
		  						)";

		  			$rst_banner = DB::insert($banner);
		        }
		    }
	    }

		return redirect('admin/dash-banner')->with(['success' => 'Upload Banner Berhasil di Proses']);
    }

    public function edit(Request $request)
    {
    	$sql = "select image_banner from banner_images where id= '".$request->id."'";
    	$banner = DB::select($sql);

    	$data['image_nama'] = $banner[0]->image_banner;

        return view ('admin.banner.edit_banner', $data);   
    }

    public function delete($id)
    {
    	$sql = "SELECT image_banner FROM banner_images WHERE id = '".$id."'";
    	$img = DB::select($sql);
    	$file_name = $img[0]->image_banner;

		$file = "assets/image/banner/".$file_name;
		if (file_exists($file)) {
		    unlink($file);
		    // echo 'File '.$filename.' has been deleted';

		    $delete = BannerImage::where('id',$id)->delete();
		} else {
		    // echo 'Could not delete '.$filename.', file does not exist';
		}

		return redirect('admin/dash-banner')->with(['success' => 'Banner Berhasil di Hapus']);
    }
}
