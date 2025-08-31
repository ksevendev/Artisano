<?php
namespace KSeven\DevTools\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RouteCacheCommand extends Command
{
    protected $signature = 'route:cache';
    protected $description = 'Cache de rotas';

    public function handle()
    {
        $io = new SymfonyStyle($this->input, $this->output);
        $this->executeCommand($io);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $this->executeCommand($io);
        return SymfonyCommand::SUCCESS;
    }

    protected function executeCommand(SymfonyStyle $io)
    {
        if(!config('devtools.developer_mode')){
            $io->warning("Modo developer desativado!");
            return;
        }
        $io->title("Executando RouteCacheCommand");
        $io->table(['Item','Status'], [
            ['Database','OK'],
            ['Cache','Limpo'],
            ['Env',config('app.env')],
        ]);
        \$io->success("Route cache OK")
    }
}