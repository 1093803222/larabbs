<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     * 事件监听系统
     *
     * @var array
     */
    protected $listen = [
        // 注册成功事件
        Registered::class => [
            // 发送认证邮件 监听器
            SendEmailVerificationNotification::class,
        ],

        // 监听认证成功事件
        \Illuminate\Auth\Events\Verified::class => [
            // 邮件认证成功监听器
            \App\Listeners\EmailVerified::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
