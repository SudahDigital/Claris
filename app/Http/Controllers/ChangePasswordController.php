<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ChangePasswordController extends Controller
{
    public function index(Request $request)
    {
    	$username = $request->username;
    	$email 	  = $request->emailuser;

    	$sql = DB::select("
    		SELECT 
    			* 
    		FROM users 
    		WHERE 
    			name ='".$username."' 
    			AND email = '".$email."' 
    	");

    	$data['name'] 		= $sql[0]->name;
    	$data['email'] 		= $sql[0]->email;
    	$data['password'] 	= $sql[0]->password;
    	$data['role']		= $sql[0]->role;

        return view ('admin.change_password', $data); 
    }

    public function update(Request $request){
        $name_user  = $request->name_user;
        $email_user = $request->email_user;

        $newpass    = $request->password;
        $confirmpass= $request->passwordCofirm;

        // $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);

        if($newpass == $confirmpass){
            $sql = DB::Update("UPDATE users SET password = '".$newpass."' WHERE name = '".$name_user."' AND email = '".$email_user."' ");

            return redirect('admin/dashboard')->with(['hasil' => 'success']);
        }else{
            return redirect()->back();
        }
    }
}
