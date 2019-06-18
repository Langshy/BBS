<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class SessionController extends Controller
{
    //添加管理员
    public function create(Request $request){

        $data = [];
        $json = [];
        $verif_token = $this->getToken();

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->type = 1;
        $user->password = md5($request->input('password'));
        $user->verif_token = $verif_token;
        $bool = $user->save();

        if($bool){
            $json['code'] = 200;
            $json['msg'] = 'success';
        }else{
            $json['code'] = 0;
            $json['msg'] = 'fail';
        }

        return json_encode($json);


    }

    public function update(Request $request){

    }

    public function show($id){

    }

    public function delete($id){

    }

    //邮件管理
    public function sendEmailConfirmationTo($username,$verif_token){
        
    }
}
