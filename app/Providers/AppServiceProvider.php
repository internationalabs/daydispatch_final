<?php

namespace App\Providers;

use App\Models\Settings\MiscItemsList;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {
        try {
            DB::connection()->getPDO();
        } catch (Exception $e) {
            dump('Database connection failed' . $e->getMessage());
        }
        $Misc_List = MiscItemsList::latest('id')->get();

        View::composer('*', static function ($view) use ($Misc_List) {
            $view->with(
                [
                    'Misc_List' => $Misc_List
                ]
            );
        });
    }
}
