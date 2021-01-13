<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Vouchers;

class DashVoucherController extends Controller
{
    public function index(Request $request)
    {
        $sql = "SELECT * FROM vouchers";
    	$voucher = DB::select($sql);

        $data['voucher'] = $voucher;

        return view ('admin.voucher.list_voucher', $data);
    }

    public function add()
    {
        return view ('admin.voucher.create_voucher');   
    }

    public function create(Request $request)
    {

    	list($day, $month, $year) 	= explode("/", $request->exp_date);
    	$expired_date 				= $year."-".$month."-".$day;

		$voucher = Vouchers::create([
			'code' 				=> $request->code_voucher,
			'name' 				=> $request->name_voucher,
			'description' 		=> $request->desc_voucher,
			'type' 				=> $request->type,
			'discount_amount' 	=> $request->amount_voucher,
			'expires_at' 		=> $expired_date,
			'max_uses' 			=> $request->max_use
		]);

		if($voucher) {
			return redirect('admin/dash-voucher')->with(['hasil' => 'success']);
		}
		return redirect('admin/dash-voucher')->with(['hasil' => 'failed']);
    }

    public function edit(Request $request)
    {

        $sql = Vouchers::where('id',$request->id)->get();

        $data['id']  			= $sql[0]->id;
        $data['code']  			= $sql[0]->code;
        $data['name']   		= $sql[0]->name;
        $data['description']  	= $sql[0]->description;
        $data['max_uses']      	= $sql[0]->max_uses;
        $data['type']         	= $sql[0]->type;
        $data['discount_amount']= $sql[0]->discount_amount;
        $exp_date 				= date("d/m/Y", strtotime($sql[0]->expires_at));
        $data['expires_at']     = $exp_date;

        return view ('admin.voucher.edit_voucher', $data);     
    }

    public function update(Request $request)
    {
    	list($day, $month, $year) 	= explode("/", $request->exp_date);
    	$expired_date 				= $year."-".$month."-".$day;

    	$update = Vouchers::where('id', $request->id)
    				->update([
    					'name' 			=> $request->name_voucher,
    					'description' 	=> $request->desc_voucher,
    					'max_uses' 		=> $request->max_use,
    					'type' 			=> $request->type,
    					'discount_amount' => $request->amount_voucher,
    					'expires_at' 	=> $expired_date
    				]);

		if($update){
            return redirect('admin/dash-voucher')->with(['hasil' => 'success']);
        }
        return redirect('admin/dash-voucher')->with(['hasil' => 'failed']);
    }

    public function delete($id)
    {
    	$delete = Vouchers::where('id',$id)->delete();

		if($delete){
            return redirect('admin/dash-voucher')->with(['hasil' => 'success']);
        }
        return redirect('admin/dash-voucher')->with(['hasil' => 'failed']);
    }
}
