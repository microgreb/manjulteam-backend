<?php

    namespace App\Providers;

    use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
    use Illuminate\Support\Facades\Route;

    class RouteServiceProvider extends ServiceProvider
    {
        /**
         * This namespace is applied to your controller routes.
         *
         * In addition, it is set as the URL generator's root namespace.
         *
         * @var string
         */
        protected $namespace = 'App\Http\Controllers';

        /**
         * Define your route model bindings, pattern filters, etc.
         *
         * @return void
         */
        public function boot()
        {
            //

            parent::boot();
        }

        /**
         * Define the routes for the application.
         *
         * @return void
         */
        public function map()
        {
            //$this->mapApiRoutes();

            $this->mapWebRoutes();

            $this->mapFrontStoreRoutes();

            $this->mapBackStoreRoutes();

            //
        }

        protected function mapFrontStoreRoutes()
        {
            Route::prefix('api/')
                ->middleware(['api'])
                ->as('front-store-')
                ->namespace('App\Http\Controllers\Api\FrontStore')
                ->group(base_path('routes/api/front-store/front-store.php'));
        }

        protected function mapBackStoreRoutes()
        {
            Route::prefix('api/back-store')
                ->middleware(['api'])
                ->as('back-store-')
                ->namespace('App\Http\Controllers\Api\BackStore')
                ->group(base_path('routes/api/back-store/back-store.php'));
        }

        /**
         * Define the "web" routes for the application.
         *
         * These routes all receive session state, CSRF protection, etc.
         *
         * @return void
         */
        protected function mapWebRoutes()
        {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        }

        /**
         * Define the "api" routes for the application.
         *
         * These routes are typically stateless.
         *
         * @return void
         */
        protected function mapApiRoutes()
        {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
        }
    }
