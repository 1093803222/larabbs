<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 三个判断验证邮件认证
        // 1. 如果用户已经登录
        // 2. 并且还未认证Email
        // 3. 并且访问的不是email相关的URL 或这退出的URL
        if ($request->user() &&
            !$request->user()->hasVerifiedEmail() &&
            !$request->is('email/*', 'logout')) {

            // 根据客户端返回对应的内容
            return $request->expectsJson()
                ? abort(403, "你的邮箱地址没有验证")
                : redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
