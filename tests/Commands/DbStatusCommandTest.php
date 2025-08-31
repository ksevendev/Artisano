<?php
namespace KSeven\DevTools\Tests\Commands;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use KSeven\DevTools\Commands\DbStatusCommand;

class DbStatusCommandTest extends TestCase
{
    public function testRunsSuccessfully()
    {
        $command = new DbStatusCommand();
        $tester = new CommandTester($command);
        $tester->execute([]);
        $output = $tester->getDisplay();
        $this->assertStringContainsString('Executando DbStatusCommand', $output);
    }
}