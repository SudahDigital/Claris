<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;

class DashUserController extends Controller
{
    public function index()
    {
    	$sql = "select * from users where role = 'admin';";
        $data['users'] = DB::select($sql);

        return view ('admin.layouts.dashuser', $data);   
    }

    public function add()
    {
        return view ('admin.layouts.inputuser');   
    }

    public function create(Request $request)
    {
		if($_POST['user_nama']!="" && $_POST['email_user']!="" && $_POST['password']!=""){
    		$errors= array();
    		// $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    		$pass = $_POST['password'];

  			$user = User::create([
				'name' => $_POST['user_nama'],
				'email' => $_POST['email_user'],
				'password' => $pass,
				'role' => 'admin'
			]);
	    }

		return redirect('admin/dash-user')->with(['success' => 'User Berhasil di Input']);
    }

    public function edit(Request $request)
    {
    	$sql = "select * from users where role = 'admin' and id= '".$request->id."'";
    	$user_sql = DB::select($sql);

    	$data['username'] 	= $user_sql[0]->name;
    	$data['email'] 		= $user_sql[0]->email;
    	$data['id'] 		= $user_sql[0]->id;

        return view ('admin.layouts.edituser', $data);   
    }

    public function update(Request $request)
    {
    	// $pass = password_hash($request->password, PASSWORD_DEFAULT);
    	$pass = $request->password;

    	$update = "update users set 
    					name = '".$request->user_nama."',
    					email = '".$request->email_user."',
    					password = '".$pass."'
    				where id = '".$request->id."'
    			";

    	$product = DB::update($update);

		return redirect('admin/dash-user')->with(['success' => 'User Berhasil di Proses']);
    }

    public function delete($id)
    {
    	echo $id;
    	$delete = User::where('id',$id)->delete();

		return redirect('admin/dash-user')->with(['success' => 'User Berhasil di Hapus']);
    }
}
