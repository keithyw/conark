<?php namespace Conark\Grecaptcha;

use Conark\Grecaptcha\Services\GrecaptchaValidatorService;
use Illuminate\Support\ServiceProvider;

class GrecaptchaServiceProvider extends ServiceProvider {

    /**
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'grecaptcha');
        $this->publishes([
            __DIR__ . '/config/grecaptcha.php' => config_path('grecaptcha.php'),
            __DIR__ . '/resources/views' => base_path('resources/views/vendor/grecaptcha'),
        ]);
        // adds the validator portion
        $this->app->validator->resolver(function($translator, $data, $rules, $messages = [], $customAttributes = []){
            $val = new GrecaptchaValidatorService($translator, $data, $rules, $messages, $customAttributes);
            $val->setGoogleRecaptchaService($this->app->make('Conark\Grecaptcha\Contracts\GoogleRecaptchaServiceInterface'));
            return $val;
        });
    }
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('Conark\Grecaptcha\Contracts\GoogleRecaptchaServiceInterface', 'Conark\Grecaptcha\Services\GoogleRecaptchaService');
	}


}
