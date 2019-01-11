<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 设定了所有控制器动作都需要登陆后才能访问
        $this->middleware('auth');
        // 对verify路由进行加密签名
        $this->middleware('signed')->only('verify');
        // 对verify和resend两个路由做了访问限制频率 为1分钟6次访问， throttle中间件为访问限制频率服务提供者
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
