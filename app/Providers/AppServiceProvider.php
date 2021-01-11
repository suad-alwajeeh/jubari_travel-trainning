<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\adds;
use App\Notification;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
View::composer('*',function($view){
    $date1=date("Y/m/d") ;
    $model = adds::where([['is_delete',0],['is_active',1],['adds_type',1]])->get(); //or any eloquent method or where clause you to use to fetch the data
   // $model = Notification::where([['status',0],['update_date',$date1]])
   // ->join('users',)->get(); //or any eloquent method or where clause you to use to fetch the data
    $view->with('addss', $model);
});

    }
}
