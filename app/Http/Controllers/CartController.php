<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
 

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
						'qty_color' => $request->product_id
					]);
		}else{
			$data = Cart::create([
				'product_id' => $request->product_id,
				'mount' => $request->jumlah,
				'user_id' => $user_id,
				'session_id' => $ses_id,
				'qty_color' => $request->product_id
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
    	$input = $request->all();
    	if ($input['type']=='plus') {
    		# code...
    		$mount = $input['mount'] + 1;
    	}else{
    		$mount = $input['mount'] - 1;
    	}
    	$cart = Cart::where('id',$input['id'])
					->update([
						'mount' => $mount,
					]);
		return response()->json('success');
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
				$data = Cart::where('product_id',$request->product_id)
						->where('user_id',$user_id)
						->where('session_id', $ses_id)
						->update([
							'product_id' => $request->product_id,
							'mount' => $jumlah,
							'user_id' => $user_id
						]);
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

				$data = Cart::create([
					'product_id' => $request->product_id,
					'mount' => $qty,
					'user_id' => $user_id,
					'session_id' => $ses_id,
					'color' => $clr,
					'user_ip' => $clientIP,
					'created_at' => $datenow,
					'updated_at' => NULL
				]);

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
		$data = Pay::create([
			'name_cust' => $request->costumer_name,
			'alamat_cust' => $request->costumer_adress,
			'telepon_cust' => $request->costumer_phone,
			'email_cust' => $request->costumer_email,
			'amount' => $request->total_pay
		]);


		return redirect('cart')->with(['success' => 'Product Berhasil di Proses']);

		/*$user_id = Auth::id();
    	if (empty($user_id)) {
			# code...
			$user_id = 0;
		}
		$data['address'] = array(
			'name' => $request->costumer_name,
			'adress' => $request->costumer_adress,
			'phone' => $request->costumer_phone,
			'user_id' => $user_id,
			'email' => $request->costumer_email,
		);
		// alamat::create($data['address']);
		// cart
		$cart = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('product_images', 'product_images.product_id', '=', 'carts.product_id')
			->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
			// ->where('product_images.is_tumbnail', 'yes')
            ->get();
        $data['cart'] = $cart;
        $data['category'] = Category::all();
		// Enable sanitization
		Veritrans_Config::$isSanitized = true;

		// Enable 3D-Secure
		Veritrans_Config::$is3ds = true;


		
		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => 18000,
		  'quantity' => 3,
		  'name' => "Apple"
		);

		// Optional
		$item2_details = array(
		  'id' => 'a2',
		  'price' => 20000,
		  'quantity' => 2,
		  'name' => "Orange"
		);
		$total = null;
		foreach ($cart as $key => $value) {
			# code...
			$total += $value->product_harga;
			$item_details[$key]['id'] = $value->id;
			$item_details[$key]['price'] = $value->product_harga;
			$item_details[$key]['name'] = $value->product_name;
			$item_details[$key]['quantity'] = $value->mount;
		}
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $total, // no decimal allowed for creditcard
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $request->costumer_name,
		  'address'       => $request->costumer_adress,
		  'email'         => $request->costumer_email,
		  'phone'         => $request->costumer_phone,
		);

		// Optional, remove this to display all available payment methods
		// $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');

		// Fill transaction details
		$transaction = array(
		  // 'enabled_payments' => $enable_payments,
		  'transaction_details' => $transaction_details,
		  'customer_details' => $customer_details,
		  'item_details' => $item_details,
		);

		$snapToken = Veritrans_Snap::getSnapToken($transaction);
    	$count = Cart::where('user_id', $user_id)->sum('mount');
		$data['snapToken'] = $snapToken;
		$data['count_cart'] = $count;
		 // return $data; die;
    	return view('layouts.pay',$data);
    	// return view('layouts.test',$data);*/
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

        $cart = DB::select("SELECT a.*, b.product_name, b.product_harga, b.product_image, a.user_ip, (b.product_harga * SUM(a.mount)) total FROM carts a LEFT JOIN products b ON a.product_id = b.id WHERE a.session_id = '".$ses_id."' GROUP BY a.user_ip");
        // return $cart;die;
        $data['count_cart'] = count($cart);
        $data['cart'] = $cart;

        $color = DB::select("SELECT a.* FROM carts a WHERE a.session_id = '".$ses_id."'");
        $data['color'] = $color;

        return view('layouts.tampil',$data);
	}
}
