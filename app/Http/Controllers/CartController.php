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
    public function index()
    {

    	$user_id = Auth::id();
    	if (empty($user_id)) {
    		# code...
    		$user_id = 0;
    	}
    	$count = Cart::where('user_id', $user_id)->sum('mount');
		
		$cart = DB::table('carts')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->leftJoin('product_images', 'product_images.product_id', '=', 'carts.product_id')
			->select('carts.*', 'products.product_name', 'products.product_harga', 'product_images.image_link')
			// ->where('product_images.is_tumbnail', 'yes')
            ->get();
        $data['cart'] = $cart;
        $data['count_cart'] = $count;
        $data['category'] = Category::all();
        // return $input;die;
        // return $data;die;
    	return view('layouts.cart_old',$data);
    }
    public function add(Request $request)
	{
		$user_id = Auth::id();
		if (empty($user_id)) {
			# code...
			$user_id = 0;
		}
		$cek = Cart::where([['product_id',$request->product_id],['user_id',$user_id]])->first();
		if (!empty($cek)) {
			# code...
			$jumlah = $request->jumlah + $cek->mount;
			$cart = Cart::where('product_id',$request->product_id)
					->where('user_id',$user_id)
					->update([
						'product_id' => $request->product_id,
						'mount' => $jumlah,
						'user_id' => $user_id,
					]);
		}else{
			$data = Cart::create([
				'product_id' => $request->product_id,
				'mount' => $request->jumlah,
				'user_id' => $user_id,
			]);
		}
		return redirect()->back()->with(['success' => 'Product Berhasil Dimasukan Kekeranjang']);
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
}
