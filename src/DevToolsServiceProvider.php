<?php
namespace KSeven\DevTools;
use Illuminate\Support\ServiceProvider;

class DevToolsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([                \KSeven\DevTools\Commands\DbStatusCommand::class,
                \KSeven\DevTools\Commands\LogsTailCommand::class,
                \KSeven\DevTools\Commands\LogsWatchCommand::class,
                \KSeven\DevTools\Commands\DevFakerCommand::class,
                \KSeven\DevTools\Commands\DevTinkerCommand::class,
                \KSeven\DevTools\Commands\MakeModelCommand::class,
                \KSeven\DevTools\Commands\MakeControllerCommand::class,
                \KSeven\DevTools\Commands\MakeServiceCommand::class,
                \KSeven\DevTools\Commands\StatusAppCommand::class,
            ]);

            // Publica Artisano CLI
            $this->publishes([
                __DIR__.'/../cli/artisano' => base_path('artisano'),
            ], 'devtools-artisano');
        }
        $this->mergeConfigFrom(__DIR__.'/../config/devtools.php','devtools');
    }
}