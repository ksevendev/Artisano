<?php
/**
 * run.php - script principal de geração de estrutura, docs e testes
 */

$projectRoot = __DIR__;
$testsDir = $projectRoot . '/tests';

// Cria diretórios
@mkdir($testsDir . '/Commands', 0777, true);
@mkdir($testsDir . '/Core', 0777, true);

// Gera bootstrap.php
file_put_contents($testsDir . '/bootstrap.php', "<?php\nrequire __DIR__ . '/../vendor/autoload.php';\n");

// Lista de comandos da biblioteca
$commands = ['ListCommand', 'DbStatusCommand', 'GenerateDocsCommand', 'UpdateCommand'];

// Gera testes para cada comando
foreach ($commands as $command) {
    $className = $command . 'Test';
    $filePath = $testsDir . '/Commands/' . $className . '.php';
    $content = <<<PHP
<?php
namespace KSeven\\DevTools\\Tests\\Commands;

use PHPUnit\\Framework\\TestCase;

class {$className} extends TestCase
{
    public function testExample()
    {
        \$this->assertTrue(true, '{$command} test placeholder');
    }
}
PHP;
    file_put_contents($filePath, $content);
    echo "✅ Teste gerado: {$filePath}\n";
}

// Testes Core
$coreTests = ['Artisano', 'Utils'];
foreach ($coreTests as $core) {
    $className = $core . 'Test';
    $filePath = $testsDir . '/Core/' . $className . '.php';
    $content = <<<PHP
<?php
namespace KSeven\\DevTools\\Tests\\Core;

use PHPUnit\\Framework\\TestCase;

class {$className} extends TestCase
{
    public function testExample()
    {
        \$this->assertTrue(true, '{$core} test placeholder');
    }
}
PHP;
    file_put_contents($filePath, $content);
    echo "✅ Teste gerado: {$filePath}\n";
}

echo "\n🎉 Todos os testes foram gerados!\n";
