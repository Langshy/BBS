<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Model\User;
use App\Model\PasswordFind;
use Illuminate\Http\Request;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //生成64为随机数
    public function getToken(){
        $token = str_random(64);
        return $token;
    }

    //记录user登录
    public function getUserLogin(User $user){
        $data = [];
        $data['id'] = $user->id;
        $data['username'] = $user->username;
        $data['email'] = $user->email;
        session()->put($data['id'], $data);
        return;
    }

    //检测user的登录状态
    public function loginStatus($id){
        if(session()->has($id)){
            return true;
        }else{
            return false;
        }
    }

    //激活邮件发送
    public function sendEmailConfirmationTo(User $user){
        $view = 'email.admin_email';
        $data = compact('user');
        $from = 'langshy@163.com';
        $name = 'Admin';
        $to = $user->email;
        $subject = "请确认你的邮箱。";
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
    
    // 验证邮箱激活
    public function confirmEmail(Request $request){
        $token = $request->input('token');

        $user = User::where('verif_token',$token)->firstOrFail();
        $user->verif_token = null;
        $user->token = $token;
        $user->save();

        $this->getUserLogin($user);

        echo '邮箱激活成功！';
        return;
    }

    //忘记密码验证
    public function sendEmailFindeTo(PasswordFind $password)
    {
        $view = 'email.password_email';
        $data = compact('password');
        $from = 'langshy@163.com';
        $name = 'Admin';
        $to = $password->email;
        $subject = "请确认你的邮箱。";
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}
