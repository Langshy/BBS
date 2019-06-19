<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\PasswordFind;

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

    //管理员登录
    public function login(Request $request){
        $json = [];
        $email = $request->input('email');
        $password = md5($request->input('password'));

        $user = User::where('email',$email)->where('password',$password)->first();
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

    //管理员登出
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

    //密码找回
    public function resetPassword(Request $request)
    {
        $json = [];
        $email = $request->input('email');
        $user = User::where('email',$email)->first();
        if($user){
            $info = PasswordFind::create([
                'email' => $email,
                'token' => $this->getToken(),
                'create_time' => time()
            ]);
    
            $this->sendEmailFindeTo($info);
            $json['code'] = 200;
            $json['msg'] = 'success';
        }else{
            $json['code'] = 0;
            $json['msg'] = 'fail';
        }

        return json_encode($json);

    }

    
    public function updatePassword(Reuqest $request)
    {
        $token = $request->input('token');
        $time = time();
        $info = PasswordFind::where('token',$token)->first();
        if(((int)$time-(int)$info->create_time) > 1800){
            //重定向到提示页面
            return;
        }else{
            //渲染修改页面
            return;
        }
    }

}
