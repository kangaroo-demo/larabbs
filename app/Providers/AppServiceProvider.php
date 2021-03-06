<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
        \App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        \App\Models\Link::observe(\App\Observers\LinkObserver::class);
        //时间本地化
        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 本地加载 sudo-su 扩展包
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }

        \API::error(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exception) {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(404, '404 Not Found');
        });

        \API::error(function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            abort(403, $exception->getMessage());
        });
    }
}
