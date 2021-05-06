<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
 
use App\CustomerOrder;
use App\Product;
use App\Category;
use App\Cart;
use App\alamat;
use App\Pay;

class CartController extends Controller
{
    //
    public function __construct()
    {
        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }
    public function index(Request $request)
    {
    	$userAgent	= $request->header('User-Agent'); //session_id();
		$clientIP 	= \Request::getClientIp(true);
		$ses_id 	= $userAgent.$clientIP;
    	$user_id = Auth::id();
    	if (empty($user_id)) {
    		# code...
    		$user_id = 0;
    	}
    	$count = Cart::where('user_id', $user_id)->sum('mount');
		
		/*$cart = DB::table('carts')
            ->innerJoin('products', 'products.id', '=', 'carts.product_id')
            ->where('session_id', $ses_id)
			->select('carts.*', 'products.product_name', 'products.product_harga', 'products.product_image')
            ->get();*/
        $sql = "SELECT carts.*, products.product_name, products.product_harga, products.product_image, (products.product_harga * carts.mount) AS total_harga FROM `carts` INNER JOIN products ON products.id = carts.product_id WHERE carts.session_id = '".$ses_id."'"; 
        $cart = DB::select($sql);

        $data['cart'] = $cart;
        $data['count_cart'] = $count;
        $data['category'] = Category::all();
        $data['status_login'] = '';
    	return view('layouts.cart_old',$data);
    }
    public function add(Request $request)
	{
		session_start();
		
		$user_id 	= Auth::id();
		$userAgent	= $request->header('User-Agent'); //session_id();
		$clientIP 	= \Request::getClientIp(true);
		$ses_id 	= $userAgent.$clientIP;
		$datenow 	= date('Y-m-d H:i:s');

		if (empty($user_id)) {
			# code...
			$user_id = 0;
		}
		$cek = Cart::where([['product_id',$request->product_id],['session_id',$ses_id]])->first();

		if (!empty($cek)) {
			# code...
			$jumlah = $request->jumlah + $cek->mount;
			$cart = Cart::where('product_id',$request->product_id)
					->where('user_id',$user_id)
					->where('session_id',$ses_id)
					->update([
						'product_id' => $request->product_id,
						'mount' => $jumlah,
						'user_id' => $user_id,
						'qty_color' => $request->product_id,
						'carts_date' => $datenow
					]);
		}else{
			$data = Cart::create([
				'product_id' => $request->product_id,
				'mount' => $request->jumlah,
				'user_id' => $user_id,
				'session_id' => $ses_id,
				'qty_color' => $request->product_id,
				'carts_date' => $datenow
			]);
		}
		return redirect()->back()->with(['status' => 'success','data' => $data]);
	}
	public function delete($id)
	{

		$delete = Cart::where('id',$id)->delete();

		return redirect('cart')->with(['success' => 'Product Berhasil Dihapus Dari Kekeranjang']);
	}
	public function update_mount(Request $request)
	{	
    	$input 		= $request->all();
    	$userAgent	= $request->header('User-Agent'); //session_id();
		$clientIP 	= \Request::getClientIp(true);
		$ses_id 	= $userAgent.$clientIP;
    	
    	$cart = Cart::where('product_id',$request->id)
    				->where('session_id',$ses_id)
    				->where('color',$request->color)
					->update([
						'mount' => $request->mount,
					]);

		$sql_tot = "SELECT SUM(A.total) tot FROM (SELECT (b.product_harga * SUM(a.mount)) total FROM carts a LEFT JOIN products b ON a.product_id = b.id WHERE a.session_id = '".$ses_id."' GROUP BY a.user_ip, a.product_id) as A";
        $rst_tot = DB::select($sql_tot);

        $total = 0;
        if($rst_tot){
        	$total = $rst_tot[0]->tot;
        }
		return response()->json([ 'status' => 'success', 'total' => $total]);
	}

	public function update_cart(Request $request)
	{	
    	$userAgent	= $request->header('User-Agent'); //session_id();
		$clientIP 	= \Request::getClientIp(true);
		$ses_id 	= $userAgent.$clientIP;
		$user_id 	= Auth::id();
		$jumlah 	= $request->jumlah;
		if (empty($user_id)) {
			# code...
			$user_id = 0;
		}

		$qty_color 	= $request->qty;
		$datenow 	= date('Y-m-d H:i:s');

			$data = [];
			$jmlh = 0;
			foreach ($qty_color as $key => $value) {
				$hsl = explode("_", $value);

				$clr = $hsl[0];
				$qty = $hsl[1];
				if($qty==""){$qty = "0";}

				$jmlh += $qty;
			}

		$cek = Cart::where([['product_id',$request->product_id],['session_id',$ses_id]])->first();
		if (!empty($cek)) {

			if($jmlh>0){

				$data = Cart::where('session_id',$ses_id)->where('product_id',$request->product_id)->delete();

				$qty_color = $request->qty;

				$data = [];
				foreach ($qty_color as $key => $value) {
					$hsl = explode("_", $value);

					$clr = $hsl[0];
					$qty = $hsl[1];

					if($qty != 0){
						$data = Cart::create([
							'product_id' => $request->product_id,
							'mount' => $qty,
							'user_id' => $user_id,
							'session_id' => $ses_id,
							'color' => $clr,
							'user_ip' => $clientIP,
							'carts_date' => $datenow,
							'created_at' => $datenow,
							'updated_at' => NULL
						]);
						/*$data = Cart::where('product_id',$request->product_id)
								->where('user_id',$user_id)
								->where('session_id', $ses_id)
								->update([
									'product_id' => $request->product_id,
									'mount' => $qty,
									'user_id' => $user_id
								]);*/
					}
				}
			}else{
				$data = Cart::where('session_id',$ses_id)->where('product_id',$request->product_id)->delete();
			}
		}elseif($jmlh>0){

			$qty_color = $request->qty;

			$data = [];
			foreach ($qty_color as $key => $value) {
				$hsl = explode("_", $value);

				$clr = $hsl[0];
				$qty = $hsl[1];

				if($qty != 0){
					$data = Cart::create([
						'product_id' => $request->product_id,
						'mount' => $qty,
						'user_id' => $user_id,
						'session_id' => $ses_id,
						'color' => $clr,
						'user_ip' => $clientIP,
						'carts_date' => $datenow,
						'created_at' => $datenow,
						'updated_at' => NULL
					]);
				}

			}

			/*$data = Cart::create([
				'product_id' => $request->product_id,
				'mount' => $request->jumlah,
				'user_id' => $user_id,
				'session_id' => $ses_id
			]);*/
		}

		$count_item = Cart::where('session_id', $ses_id)->count();

		$total_price = DB::Select("SELECT  SUM(A.mount * B.product_harga) AS TOT_HARGA FROM carts AS A INNER JOIN products AS B ON A.product_id = B.id WHERE A.session_id = '".$ses_id."'");
		
		return response()->json(['status' => 'success', 'mount' => $count_item, 'total_price' => $total_price[0]->TOT_HARGA ]);
	}

	public function pay(Request $request)
	{
		$userAgent	= $request->header('User-Agent'); //session_id();
		$clientIP 	= \Request::getClientIp(true);
		$ses_id 	= $userAgent.$clientIP;
		$date 		= date('Y-m-d H:i:s');
		$dt 		= date('YmdHis');


		$inv_pay 	= $dt;

		$input_pay = "INSERT INTO pay (
						invoice_pay,
						name_cust,
						alamat_cust,
						telepon_cust,
						email_cust,
						total_price,
						order_date,
						status,
						created_at
					) VALUES (
						'".$inv_pay."',
						'".$request->costumer_name."',
						'".$request->costumer_adress."',
						'".$request->costumer_phone."',
						'".$request->costumer_email."',
						'".$request->total_pay."',
						now(),
						'SUBMIT',
						now()
					); 
				";

		$rst_pay = DB::insert($input_pay);

		$cart = DB::select("SELECT * FROM carts where session_id = '".$ses_id."'");
        foreach ($cart as $key => $value) {

			$sql  = DB::table('products')
					->where('id', $value->product_id)
					->select('products.product_stock','products.product_code')->get();

			$pcode 		= $sql[0]->product_code;
			$qty_before = $sql[0]->product_stock;
			$qty_after 	= ($qty_before - $value->mount);

			$prod = Product::where('id',$value->product_id)
				->update([
					'product_stock' => $qty_after
			]);

			$input_pay_detail = "INSERT INTO pay_d (
						invoice_pay,
						name_cust,
						alamat_cust,
						telepon_cust,
						email_cust,
						mount,
						order_date,
						product_id,
						product_code,
						color,
						carts_date,
						status
					) VALUES (
						'".$inv_pay."',
						'".$request->costumer_name."',
						'".$request->costumer_adress."',
						'".$request->costumer_phone."',
						'".$request->costumer_email."',
						'".$value->mount."',
						now(),
						'".$value->product_id."',
						'".$pcode."',
						'".$value->color."',
						'".$value->carts_date."',
						'SUBMIT'
					); 
				";
			$rst_pay_detail = DB::insert($input_pay_detail);
        	
        }

		// return redirect('home')->with(['success' => 'Product Berhasil di Proses']);
		if($rst_pay){
			$href='*Hello Admin Claris*,  %0ANo. Hp %3A' .$request->costumer_phone.', %0AAlamat %3A' .$request->costumer_adress.', %0AKota/kab %3A' .$request->city_name.',%0APesanan %3A%0A';

            $pesan = DB::select("
				            	SELECT 
				            		* 
				            	FROM pay_d a
				            	INNER JOIN pay b ON a.invoice_pay = b.invoice_pay
				            	INNER JOIN products c ON a.product_id = c.id
				            	INNER JOIN carts d ON a.product_id = c.id AND a.carts_date = d.carts_date AND a.color = d.color
				            	WHERE a.telepon_cust = '".$request->costumer_phone."'
            						
            ");
            foreach($pesan as $key=>$wa){
                $href.='*'.$wa->product_name.'%20(Qty %3A%20'.$wa->mount.' Pcs, Color %3A%20'.$wa->color.')%0A';
            }

            if($request->kode_promo !=""){
	            $sql_promo  = DB::table('vouchers')
						->where('code', $request->kode_promo)
						->select('vouchers.code','vouchers.name','vouchers.discount_amount','vouchers.uses','vouchers.max_uses')->get();

				$promo_cd 		= $sql_promo[0]->code;
				$promo_nm 		= $sql_promo[0]->name;
				$promo_dis 		= $sql_promo[0]->discount_amount;
				$promo_uses 	= $sql_promo[0]->uses;
				$promo_max_uses	= $sql_promo[0]->max_uses;

				$sql_cart 	= "SELECT SUM((products.product_harga * carts.mount)) AS total_harga FROM `carts` INNER JOIN products ON products.id = carts.product_id WHERE carts.session_id = '".$ses_id."'";
				$rst_cart2 	= DB::select($sql_cart);
				$jumlah_byr = $rst_cart2[0]->total_harga;

				$diskon 		= $promo_dis/100;
				$potongan 		= $jumlah_byr*$diskon;
				$total_bayar 	= $jumlah_byr-$potongan;

				if($promo_cd !=""){
					$info_harga = 'Total Pesanan %3A Rp.'.number_format(($jumlah_byr), 0, ',', '.').'%0ADiskon %3A '.number_format(($promo_dis), 0, ',', '.').'% %0AJenis Diskon %3A '.$promo_nm.' %0ATotal Pembayaran %3A Rp.'.number_format(($total_bayar), 0, ',', '.').'%0A';

					$uses 				= $promo_uses+1;
					if($promo_max_uses!=$uses){
						$upd_used_voucher 	= "UPDATE vouchers SET 
													uses = '$uses'
												WHERE code = '$request->kode_promo'
											";
						$rst_used_voucher 	= DB::update($upd_used_voucher);
					}
				}
			}else{
				$sql_cart 	= "SELECT SUM((products.product_harga * carts.mount)) AS total_harga FROM `carts` INNER JOIN products ON products.id = carts.product_id WHERE carts.session_id = '".$ses_id."'";
				$rst_cart2 	= DB::select($sql_cart);
				$jumlah_byr = $rst_cart2[0]->total_harga;
				
				$info_harga = 'Total Pembayaran %3A Rp.'.number_format(($jumlah_byr), 0, ',', '.').'%0A';
			}

			$sql_cust_order = DB::select("SELECT * FROM customer_order WHERE ip_address = '".$clientIP."' AND user_agent = '".$userAgent."'");
			$count_cust_order = count($sql_cust_order);

			if($count_cust_order <= 0){
				$insert_cust_order = CustomerOrder::create([
						'no_telp' => $request->costumer_phone,
						'address' => $request->costumer_adress,
						'city' => $request->city_name,
						'ip_address' => $clientIP,
						'user_agent' => $userAgent
					]);
			}

			$del_cart = "DELETE FROM carts
					WHERE 
						session_id 	= '".$ses_id."'
					";
			$rst_cart = DB::statement($del_cart);

			$text_wa=$href.'%0A'.$info_harga;
            $url = "https://api.whatsapp.com/send?phone=6281776492873&text=$text_wa";
            return Redirect::to($url);
	        
	    }
	}

	public function footer_list(Request $request)
	{
		$userAgent	= $request->header('User-Agent'); //session_id();
		$clientIP 	= \Request::getClientIp(true);
		$ses_id 	= $userAgent.$clientIP;
		/*$cart = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.session_id', $ses_id)
            ->select('carts.*', 'products.product_name', 'products.product_harga', 'products.product_image')
            ->get();*/

        $cart = DB::select("SELECT a.*, b.product_name, b.product_harga, b.product_image, a.user_ip, (b.product_harga * SUM(a.mount)) total FROM carts a LEFT JOIN products b ON a.product_id = b.id WHERE a.session_id = '".$ses_id."' GROUP BY a.user_ip, a.product_id");
        // return $cart;die;
        $data['count_cart'] = count($cart);
        $data['cart'] = $cart;

        $sql_tot = "SELECT SUM(A.total) tot FROM (SELECT (b.product_harga * SUM(a.mount)) total FROM carts a LEFT JOIN products b ON a.product_id = b.id WHERE a.session_id = '".$ses_id."' GROUP BY a.user_ip, a.product_id) as A";
        $rst_tot = DB::select($sql_tot);

        $data['total_hrg'] = 0;
        if($rst_tot){
        	$data['total_hrg'] = $rst_tot[0]->tot;
        }

        $color = DB::select("SELECT a.* FROM carts a WHERE a.session_id = '".$ses_id."'");
        $data['color'] = $color;

        return view('layouts.tampil',$data);
	}
}
