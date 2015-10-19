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
        $this->app->bind('App\Own\Auth\UserAuth', 'App\Own\Auth\TokenAuth');
        $this->app->bind('App\Own\Repositories\AvailableCurrenciesRepo\AvailableCurrenciesRepo', 'App\Own\Repositories\AvailableCurrenciesRepo\EloquentAvailableCurrenciesRepo');
        $this->app->bind('App\Own\Repositories\BidSearchRepo\BidSearchRepo', 'App\Own\Repositories\BidSearchRepo\EloquentBidSearchRepo');
        $this->app->bind('App\Own\Repositories\BidsRepo\BidsRepo', 'App\Own\Repositories\BidsRepo\EloquentBidsRepo');
        $this->app->bind('App\Own\Repositories\ChatRepo\ChatRepo', 'App\Own\Repositories\ChatRepo\EloquentChatRepo');
        $this->app->bind('App\Own\Repositories\CurrencyBatchRepo\CurrencyBatchRepo', 'App\Own\Repositories\CurrencyBatchRepo\EloquentCurrencyBatchRepo');
        $this->app->bind('App\Own\Repositories\CurrencyPriceRepo\CurrencyPriceRepo', 'App\Own\Repositories\CurrencyPriceRepo\EloquentCurrencyPriceRepo');
        $this->app->bind('App\Own\Repositories\FriendsRepo\FriendsRepo', 'App\Own\Repositories\FriendsRepo\EloquentFriendsRepo');
        $this->app->bind('App\Own\Repositories\ImageRepo\ImageRepo', 'App\Own\Repositories\ImageRepo\EloquentImageRepo');
        $this->app->bind('App\Own\Repositories\MessageRepo\MessageRepo', 'App\Own\Repositories\MessageRepo\EloquentMessageRepo');
        $this->app->bind('App\Own\Repositories\UserRepo\UserRepo', 'App\Own\Repositories\UserRepo\EloquentUserRepo');
    }
}
