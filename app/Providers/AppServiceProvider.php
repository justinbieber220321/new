<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->_logSql();

        //Facade to Object binding => add to register function
        $this->app->bind('chanellog', 'App\Helpers\Supports\Logging\ChannelWriter');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function _logSql()
    {
        if (false) { // @todo set value condition to config
            return true;
        }

        $now = '[' . date('d/m/Y H:i:s') . ']';
        $path = 'logs/backend/' . date('Y-m-d');
        $path = storage_path($path, '/');

        if(!file_exists($path)) {
            // path does not exist
            mkdir($path, 0777, true);
        }

        DB::listen(function($query) use ($now, $path) {
            File::append(
                $path . '/query.log',
                $now . ': ' . sql_binding($query->sql, $query->bindings) . PHP_EOL
            );
        });
    }
}
