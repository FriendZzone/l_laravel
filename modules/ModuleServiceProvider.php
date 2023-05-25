<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\User\src\Commands\TestCommand;
use Modules\User\src\Http\Middlewares\DemoMiddleware;

class ModuleServiceProvider extends ServiceProvider
{
    private  $middlewares = [
        'demo' => DemoMiddleware::class
    ];
    private $commands = [
        TestCommand::class

    ];

    public function boot()
    {
        $directories = $this->getModule();
        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $this->registerModule($directory);
            }
        }
    }
    public function register()
    {
        $directories = $this->getModule();
        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $this->registerConfig($directory);
            }
        }

        // Middleware configuration
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }


        // command
        $this->commands($this->commands);
    }

    private function getModule()
    {
        return array_map('basename', File::directories(__DIR__));
    }

    private function registerConfig($directory)
    {
        $configPath = __DIR__ . "/$directory/configs";
        if (File::exists($configPath)) {
            $configFiles = array_map('basename', File::allFiles($configPath));
            foreach ($configFiles as $file) {
                $alias = basename($file, '.php');
                $this->mergeConfigFrom($configPath . "/$file", $alias);
            }
        }
    }

    private function registerModule($module)
    {
        $modulePath = __DIR__ . "/{$module}";

        // Routes
        if (File::exists($modulePath . '/routes/routes.php')) {
            $this->loadRoutesFrom($modulePath . '/routes/routes.php');
        }

        // Migrations
        if (File::exists($modulePath . '/migrations')) {
            $this->loadMigrationsFrom($modulePath . 'migrations');
        }

        // Language
        if (File::exists($modulePath . '/resources/languages')) {
            $this->loadTranslationsFrom($modulePath . '/resources/languages', $module);
        }

        // Views
        if (File::exists($modulePath . '/resources/views')) {
            $this->loadViewsFrom($modulePath . '/resources/views', $module);
        }

        // Helpers
        if (File::exists($modulePath . '/helpers')) {
            $helperList = File::allFiles($modulePath . '/helpers');
            if (!empty($helperList)) {
                foreach ($helperList as $helper) {
                    $file = $helper->getPathname();
                    require $file;
                }
            }
        }
    }
}
