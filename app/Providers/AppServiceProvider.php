<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB,Auth;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // view()->composer(['socket'],function($view){
        //     if(!Auth::guest()){
        //         $id = Auth::user()->id;
        //         $messages = [];
        //         $group = DB::table('group_messages')->where('users_id',$id)->first();
        //         if( $group){
        //             $messages = DB::table('messages')->where('group_id',$group->id)->orderBy('id','desc')->paginate(15);
        //         }
        //         $view->with(['messages'=>$messages]);
        //     }
        // });
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
