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
    	$sql = "SELECT * FROM users";
        $data['users'] = DB::select($sql);

        return view ('admin.user.list_user', $data);   
    }

    public function add()
    {
        return view ('admin.user.create_user');   
    }

    public function create(Request $request)
    {
		if($_POST['user_nama']!="" && $_POST['email_user']!="" && $_POST['password']!=""){
    		// $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    		$pass = $_POST['password'];

  			$user = User::create([
				'name' => $_POST['user_nama'],
                'full_name' => $_POST['full_nama'],
				'email' => $_POST['email_user'],
				'password' => $pass,
				'role' => 'admin'
			]);
	    }

		if($user){
            return redirect('admin/dash-user')->with(['hasil' => 'success']);
        }
        return redirect('admin/dash-user')->with(['hasil' => 'failed']);
    }

    public function edit(Request $request)
    {
    	$role_user = Auth::user();
        $user_status        = $role_user->role;

        $sql = "SELECT * FROM users WHERE id= '".$request->id."'";
        $user_sql = DB::select($sql);

        $data['role_user']  = $user_sql[0]->role;
        $data['username']   = $user_sql[0]->name;
        $data['full_name']  = $user_sql[0]->full_name;
        $data['email']      = $user_sql[0]->email;
        $data['id']         = $user_sql[0]->id;

        return view ('admin.user.edit_user', $data);     
    }

    public function update(Request $request)
    {
    	// $pass = password_hash($request->password, PASSWORD_DEFAULT);
    	$pass = $request->password;

    	$update = "UPDATE users SET 
    					name = '".$request->user_nama."',
                        full_name = '".$request->full_nama."',
    					email = '".$request->email_user."',
    					password = '".$pass."'
    				WHERE id = '".$request->id."'
    			";

    	$product = DB::update($update);

		if($product){
            return redirect('admin/dash-user')->with(['hasil' => 'success']);
        }
        return redirect('admin/dash-user')->with(['hasil' => 'failed']);
    }

    public function delete($id)
    {
    	$delete = User::where('id',$id)->delete();

		if($delete){
            return redirect('admin/dash-user')->with(['hasil' => 'success']);
        }
        return redirect('admin/dash-user')->with(['hasil' => 'failed']);
    }
}
