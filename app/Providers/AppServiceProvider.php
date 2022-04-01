<?php

namespace App\Providers;

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
        Validator::extend('address', function ($attribute, $value) {
		    return !empty($value) && Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
			'address' => str_replace(' ', '+', preg_replace("/[^ \w]+/", "", $value)),
			'key' => env('GOOGLE_MAPS_API_KEY')
		    ])->json()['status'] === 'OK' ? TRUE : FALSE;
		});
    }
}
