<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Pay;
use App\Pay_d;
use App\Product;

class DashOrderController extends Controller
{
    public function list_order(Request $request)
    {   
        $where ="";
        if ($request->status == 'SUBMIT') {
            $where              = "WHERE a.status = 'SUBMIT'";
        }elseif ($request->status == 'PROCESS') {
           $where               = "WHERE a.status = 'PROCESS'";
        }elseif ($request->status == 'FINISH') {
            $where              = "WHERE a.status = 'FINISH'";
        }else if($request->status == 'CANCEL'){
            $where              = "WHERE a.status = 'CANCEL'";
        }
        
        $role_user          = Auth::user();
        $data['role_user']  = $role_user->role;

        $sql = "SELECT DISTINCT
        			a.*
        		FROM pay AS a
        		INNER JOIN pay_d AS b ON a.order_date = b.order_date AND a.telepon_cust = b.telepon_cust
                $where
        ";

    	$pay = DB::select($sql);
        $data['pay'] = $pay;

        return view ('admin.order.list_order', $data);   
    }

    public function detail(Request $request)
    {

        $role_user = Auth::user();
        $data['role_user']       = $role_user->role;

        $sql = "SELECT DISTINCT
        			a.*,
        			b.id,
        			b.status,
                    b.total_price,
                    b.order_date
        		FROM pay_d AS a
        		INNER JOIN pay AS b ON a.order_date = b.order_date AND a.telepon_cust = b.telepon_cust
        		WHERE a.id = '".$request->id."'
        ";
    	$pay_d = DB::select($sql);
        $data['name_cust'] 		= $pay_d[0]->name_cust;
        $data['alamat_cust'] 	= $pay_d[0]->alamat_cust;
        $data['telepon_cust'] 	= $pay_d[0]->telepon_cust;
        $data['email_cust'] 	= $pay_d[0]->email_cust;
        $data['status'] 		= $pay_d[0]->status;
        $data['order_id'] 		= $pay_d[0]->id;
        $data['total_price']    = number_format($pay_d[0]->total_price);
        $data['order_date']     = $pay_d[0]->order_date;

        $sql_o = "SELECT 
        			b.id,
        			a.product_id,
        			c.product_name,
        			a.mount
        		FROM pay_d AS a
        		INNER JOIN pay AS b ON a.order_date = b.order_date AND a.telepon_cust = b.telepon_cust
        		INNER JOIN products AS c ON a.product_id = c.id
        		WHERE b.id = '".$request->id."'
        ";
    	$rst_o = DB::select($sql_o);
    	$data['data_o'] = $rst_o;

        // return $data;   
        return view ('admin.order.detail_order', $data);
    }

   	public function update_order(Request $request)
    {
    	$update = "update pay set 
    					status = '".$request->status."'
    				where id = '".$request->order_id."' 
    			";

    	$product = DB::update($update);

		return redirect('admin/list-order')->with(['success' => 'Product Berhasil di Proses']);
    }

    public function edit(Request $request)
    {
        $role_user = Auth::user();
        $data['role_user']       = $role_user->role;

        $sql = "SELECT DISTINCT
                    a.*,
                    b.id,
                    b.status,
                    b.total_price,
                    b.order_date,
                    b.amount
                FROM pay_d AS a
                INNER JOIN pay AS b ON a.order_date = b.order_date AND a.telepon_cust = b.telepon_cust
                WHERE a.id = '".$request->id."'
        ";
        $pay_d = DB::select($sql);
        $data['name_cust']      = $pay_d[0]->name_cust;
        $data['alamat_cust']    = $pay_d[0]->alamat_cust;
        $data['telepon_cust']   = $pay_d[0]->telepon_cust;
        $data['email_cust']     = $pay_d[0]->email_cust;
        $data['status']         = $pay_d[0]->status;
        $data['order_id']       = $pay_d[0]->id;
        $data['total_price']    = number_format($pay_d[0]->total_price);
        $data['amount']         = $pay_d[0]->amount;
        $data['order_date']     = $pay_d[0]->order_date;

        $sql_o = "SELECT 
                    b.id,
                    a.product_id,
                    c.product_name,
                    a.mount,
                    a.id AS pay_id
                FROM pay_d AS a
                INNER JOIN pay AS b ON a.order_date = b.order_date AND a.telepon_cust = b.telepon_cust
                INNER JOIN products AS c ON a.product_id = c.id
                WHERE b.id = '".$request->id."'
        ";
        $rst_o = DB::select($sql_o);
        $data['data_o'] = $rst_o;

        $sql_p = Product::All();
        $data['data_p'] = $sql_p;

        // return $data;   
        return view ('admin.order.edit_order', $data);
    }

    public function edit_order(Request $request){

        $pay = "update pay set 
                        name_cust       = '".$request->name_cust."',
                        alamat_cust     = '".$request->alamat_cust."',
                        telepon_cust    = '".$request->telepon_cust."',
                        email_cust      = '".$request->email_cust."',
                        status          = '".$request->status."'
                    where id = '".$request->order_id."' 
                ";
        $rst_pay = DB::update($pay);

        $countProd = $request->amount;
        for($i=0; $i<$countProd; $i++){

            $product_id = $request->product_name_."".$i;

            $pay_d = "UPDATE pay_d SET 
                        name_cust       = '".$request->name_cust."',
                        alamat_cust     = '".$request->alamat_cust."',
                        telepon_cust    = '".$request->telepon_cust."',
                        email_cust      = '".$request->email_cust."',
                        status          = '".$request->status."',
                        mount           = '".$_POST['mount_'.$i]."'
                    WHERE 
                        id              = '".$_POST['id_detail_'.$i]."'
                        AND product_id  = '".$_POST['product_id_'.$i]."' 
                        AND order_date  = '".$request->order_date."' 
                ";

            // echo $pay_d."<br>";
            $rst_p = DB::update($pay_d);

            if(!$rst_p){
                return redirect('admin/list-order')->with(['error' => 'Gagal proses detail Order']);
            }
        }//exit();

        return redirect('admin/list-order')->with(['success' => 'Product Berhasil di Proses']);
    }
}
