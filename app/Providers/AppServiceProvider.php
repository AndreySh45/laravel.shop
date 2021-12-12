<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Category;
use Darryldecode\Cart\Cart;
use App\Observers\ProductObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrap();
        $categories = Category::orderBy('id')->get();
        View::share(compact('categories'));
        Blade::directive('routeactive', function ($route) {
            return "<?php echo Route::currentRouteNamed($route) ? 'class=\"hassubs active\"' : 'class=\"hassubs\"' ?>";
        });

        Product::observe(ProductObserver::class);
    }
}
