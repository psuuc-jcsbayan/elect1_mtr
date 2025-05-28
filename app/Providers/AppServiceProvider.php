<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Thread;
use App\Models\Reply;
use App\Policies\ThreadPolicy;
use App\Policies\ReplyPolicy;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $policies = [
    Thread::class => ThreadPolicy::class,
    Reply::class => ReplyPolicy::class,
];

    public function register(): void
    {
        //

        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
