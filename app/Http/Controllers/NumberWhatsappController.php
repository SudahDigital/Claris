<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NumberWhatsappController extends Controller
{
    public function index(Request $request)
    {
    	$sql = "SELECT *
            FROM whatsapp_area 
        ";
        $whatsapp_area = DB::select($sql);
        $data['whatsapp_area'] = $whatsapp_area;

        return view ('admin.whatsapp_number.list_number', $data); 
    }

    public function add()
    {
        $data['cities'] = DB::select("SELECT * FROM cities ORDER BY id ASC");
        return view ('admin.whatsapp_number.create_number', $data);   
    }


    public function create(Request $request)
    {
    	$area_name = $request->area_name;
    	$area_number = $request->area_number;
    	$area = $request->area;

    	$newArea = new \App\whatsappArea;
    	$newArea->area_name = $area_name;
    	$newArea->area_number = "62".$area_number;
    	$newArea->save();

    	$sql = DB::select("SELECT * FROM whatsapp_area WHERE area_name = '".$area_name."'");

    	foreach ($sql as $key => $value) {
    		$area_id = $value->id;

    		for ($i=0; $i < count($area); $i++) { 
	    		$cities = DB::update("UPDATE cities SET area_id = '".$area_id."' WHERE id = '".$area[$i]."'");
	    	}
    	}

    	return redirect('admin/dash-area-number')->with(['hasil' => 'Success']);
    }

    public function edit(Request $request)
    {
    	$sql = "SELECT *
            FROM whatsapp_area 
            WHERE id = '".$request->id."'
        ";
        $whatsapp_area = DB::select($sql);

        foreach ($whatsapp_area as $key => $value) {
        	$data['id'] = $value->id;
        	$data['area_name'] = $value->area_name;
        	$data['area_number'] = $value->area_number;
        }

        $data['cities'] = DB::select("SELECT * FROM cities ORDER BY id ASC");

        return view ('admin.whatsapp_number.edit_number', $data); 
    }

    public function update(Request $request)
    {
    	$id = $request->area_id;
    	$area_name = $request->area_name;
    	$area_number = $request->area_number;
    	$area = $request->area;

    	$updateArea = DB::update("UPDATE whatsapp_area SET area_name = '".$area_name."', area_number = '".$area_number."' WHERE id = '".$id."'");

    	$sql = DB::select("SELECT * FROM whatsapp_area WHERE id = '".$id."'");

    	foreach ($sql as $key => $value) {
    		$area_id = $value->id;

    		$updateCities = DB::update("UPDATE cities SET area_id = '0' WHERE area_id = '".$area_id."'");

    		for ($i=0; $i < count($area); $i++) { 
	    		$updateCities1 = DB::update("UPDATE cities SET area_id = '".$area_id."' WHERE id = '".$area[$i]."'");
	    	}
    	}

    	return redirect('admin/dash-area-number')->with(['hasil' => 'Success']);
    }

    public function delete(Request $request)
    {
    	$delete = \App\whatsappArea::where('id',$request->id)->delete();
    	if ($delete) {
    		$updateCities = DB::update("UPDATE cities SET area_id = '0' WHERE area_id = '".$request->id."'");

    		return redirect('admin/dash-area-number')->with(['hasil' => 'Success']);
    	}
    }
}
