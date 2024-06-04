<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use View;

use Auth;
use App\Footer;
use App\Events;
use App\Configurations;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		Schema::defaultStringLength(255); //Increase string length
		\Carbon\Carbon::setLocale($this->app->getLocale());		
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
	}
}
