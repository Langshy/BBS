<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Mail;

class SessionController extends Controller
{
    //添加管理员
    public function create(Request $request){

        $data = [];
        $json = [];

        $hsuser = User::where('email','=',$request->input('email'))->first();

        if($hsuser){
            $json['code'] = 0;
            $json['msg'] = 'fail';
            return json_encode($json);
        }

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'type' => 1,
            'password' => md5($request->input('password')),
            'verif_token' => $this->getToken(),
        ]);

        $json['code'] = 200;
        $json['msg'] = 'success';
        $this->sendEmailConfirmationTo($user);
        return json_encode($json);


    }

    public function login(Request $request){
        $json = [];
        $email = $request->input('email');
        $password = md5($request->input('password'));

        $user = User::where('email','=',$email)->where('password','=',$password)->first();
        if($user){
            if($user->token){
                if($user->status!=1){
                    $json['code'] = 404;
                    $json['msg'] = 'fail';
                }else {
                    $this->getUserLogin($user);
                    $json['code'] = 200;
                    $json['msg'] = 'success';
                }
            }else{
                $json['code'] = 500;
                $json['msg'] = 'fail';
            }
        }else{
            $json['code'] = 0;
            $json['msg'] = 'fail';
        }

        return json_encode($json);
    }

    //user登出
    public function loginOut($id){
        session()->pull($id);
        return;
    }

    public function show($id){

    }

    public function delete($id){

    }

    public function getAllSession(Request $request){
        print_r($request->session()->get(0));
        return;
    }

}
