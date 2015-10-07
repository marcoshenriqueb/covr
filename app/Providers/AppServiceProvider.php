<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Chat;
use App\Events\ChatHasBeenDeleted;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Chat::deleted(function($chat){
          $id = ($chat->user_1 == Auth::id()) ? $chat->user_2 : $chat->user_1;
          event(new ChatHasBeenDeleted($id, $chat->id));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
