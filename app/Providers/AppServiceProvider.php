<?php

namespace App\Providers;

use App\Models\Lookbooks\Images\LookbookImage;
use App\Models\Lookbooks\Lookbook;
use App\Models\Products\Images\ProductImage;
use App\Models\Products\Product;
use App\Observer\DependedFiles\DeleteFilesBelongsObserver;
use App\Observer\DependedFiles\DeleteFilesDependedObserver;
use App\Observer\DependedFiles\DeleteFilesProductObserver;
use App\Services\Users\AuthService;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthService::class, static function () {
            return new AuthService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPassport();

        Product::observe(DeleteFilesProductObserver::class);
        ProductImage::observe(DeleteFilesDependedObserver::class);

        Lookbook::observe(DeleteFilesBelongsObserver::class);
        LookbookImage::observe(DeleteFilesDependedObserver::class);
    }

    private function registerPassport()
    {
        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
