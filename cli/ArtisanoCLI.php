<?php
namespace KSeven\DevTools\CLI;
use Symfony\Component\Console\Application;

class ArtisanoCLI
{
    protected Application $app;

    public function __construct()
    {
        $this->app = new Application('Artisano CLI', '2.0.0');
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        $classes = [            \KSeven\DevTools\Commands\DbStatusCommand::class,
            \KSeven\DevTools\Commands\LogsTailCommand::class,
            \KSeven\DevTools\Commands\LogsWatchCommand::class,
            \KSeven\DevTools\Commands\DevFakerCommand::class,
            \KSeven\DevTools\Commands\DevTinkerCommand::class,
            \KSeven\DevTools\Commands\MakeModelCommand::class,
            \KSeven\DevTools\Commands\MakeControllerCommand::class,
            \KSeven\DevTools\Commands\MakeServiceCommand::class,
            \KSeven\DevTools\Commands\StatusAppCommand::class,
        ];
        foreach($classes as $c){
            $this->app->add(new $c());
        }
    }

    public function run()
    {
        $this->app->run();
    }
}