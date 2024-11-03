<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware as MiddlewareRoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // Route::middleware(['web', 'auth'])
            //     ->prefix('dashboard/product')
            //     ->name('dashboard.product.')
            //     ->group(base_path('routes/product.php'));

                Route::middleware(['web', 'role:administrator'])
                ->prefix('dashboard/product')
                ->name('dashboard.product.')
                ->group(base_path('routes/product.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/accounts')
                ->name('dashboard.accounts.')
                ->group(base_path('routes/account.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/report')
                ->name('dashboard.reports.')
                ->group(base_path('routes/report.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/roles')
                ->name('dashboard.roles.')
                ->group(base_path('routes/role.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/testimonial')
                ->name('dashboard.testimonial.')
                ->group(base_path('routes/testimonial.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/campaign')
                ->name('dashboard.campaign.')
                ->group(base_path('routes/campaign.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/product-purchase')
                ->name('dashboard.product-purchase.')
                ->group(base_path('routes/product-purchase.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/stock-out-product')
                ->name('dashboard.stock.')
                ->group(base_path('routes/stock.php'));
                
                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/pos')
                ->name('dashboard.pos.')
                ->group(base_path('routes/pos.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/general-settings')
                ->name('dashboard.')
                ->group(base_path('routes/general-settings.php'));

                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/media')
                ->name('dashboard.')
                ->group(base_path('routes/media.php'));
             
                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/customers')
                ->name('dashboard.customers.')
                ->group(base_path('routes/customers.php'));

                // ddressBookController
                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/address-book')
                ->name('dashboard.address-book.')
                ->group(base_path('routes/address-book.php'));

                   // ddressBookController
                   Route::middleware(['web', 'auth'])
                   ->prefix('dashboard/orders')
                   ->name('dashboard.orders.')
                   ->group(base_path('routes/orders.php'));

                //  CommentController
                Route::middleware(['web', 'auth'])
                ->prefix('dashboard/comments')
                ->name('dashboard.comments.')
                ->group(base_path('routes/comments.php'));
                  
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: [
            'cart_id'
        ]);

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    