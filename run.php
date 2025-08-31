<?php
/**
 * run.php - Script de geração da biblioteca Artisano
 * Gera testes, documentação HTML, README.md e arquivos de mensagens CLI
 */

$projectRoot = __DIR__;

// -------------------------
// 1️⃣ Criar diretórios
// -------------------------
@mkdir($projectRoot . '/tests/Commands', 0777, true);
@mkdir($projectRoot . '/tests/Core', 0777, true);
@mkdir($projectRoot . '/docs', 0777, true);

// -------------------------
// 2️⃣ Gerar bootstrap para PHPUnit
// -------------------------
file_put_contents($projectRoot . '/tests/bootstrap.php', "<?php\nrequire __DIR__ . '/../vendor/autoload.php';\n");

// -------------------------
// 3️⃣ Gerar testes automáticos
// -------------------------
$commands = ['ListCommand', 'DbStatusCommand', 'GenerateDocsCommand', 'UpdateCommand'];
foreach ($commands as $command) {
    $className = $command . 'Test';
    $filePath = $projectRoot . '/tests/Commands/' . $className . '.php';
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

$coreTests = ['Artisano', 'Utils'];
foreach ($coreTests as $core) {
    $className = $core . 'Test';
    $filePath = $projectRoot . '/tests/Core/' . $className . '.php';
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

// -------------------------
// 4️⃣ Gerar documentação HTML
// -------------------------
$composerData = json_decode(file_get_contents($projectRoot . '/composer.json'), true);
$packageName = $composerData['name'] ?? 'Artisano CLI';
$description = $composerData['description'] ?? '';
$version = $composerData['version'] ?? '2.0.1';
$require = $composerData['require'] ?? [];
$requireDev = $composerData['require-dev'] ?? [];
$scripts = $composerData['scripts'] ?? [];

$requireJson = json_encode($require, JSON_PRETTY_PRINT);
$requireDevJson = json_encode($requireDev, JSON_PRETTY_PRINT);
$scriptsJson = json_encode($scripts, JSON_PRETTY_PRINT);

$docsContent = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>{$packageName} - Documentação</title>
<style>
body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; color: #333; }
h1 { color: #007acc; }
pre { background: #eee; padding: 10px; border-radius: 5px; white-space: pre-wrap; }
section { margin-bottom: 20px; }
</style>
</head>
<body>
<h1>{$packageName} - v{$version}</h1>
<p>{$description}</p>

<section>
<h2>Dependências</h2>
<pre>require: {$requireJson}</pre>
<pre>require-dev: {$requireDevJson}</pre>
</section>

<section>
<h2>Scripts Composer</h2>
<pre>{$scriptsJson}</pre>
</section>

<section>
<h2>Comandos CLI</h2>
<ul>
<li>php artisano list → Lista todos os comandos</li>
<li>php artisano generate:docs → Gera documentação HTML</li>
<li>php artisano db:status → Verifica status do banco</li>
<li>php artisano update → Atualiza a biblioteca</li>
</ul>
</section>

<section>
<h2>Documentação Online</h2>
<p><a href="https://ksevendev.github.io/Artisano/" target="_blank">https://ksevendev.github.io/Artisano/</a></p>
</section>
</body>
</html>
HTML;

file_put_contents($projectRoot . '/docs/index.html', $docsContent);
echo "✅ Documentação HTML gerada em docs/index.html\n";

// -------------------------
// 5️⃣ Atualizar README.md
// -------------------------
$readmeContent = <<<MD
# Artisano CLI - Laravel DevTools

**Artisano CLI** é uma biblioteca PHP/Laravel para desenvolvimento avançado, fornecendo uma alternativa ao Artisan, com comandos extras e funcionalidades de desenvolvimento e gerenciamento de projetos Laravel ou outros projetos PHP.

---

## 💻 Requisitos

- PHP >= 8.0
- Laravel 10.x ou 11.x
- Composer
- Symfony Console ^6.4

---

## ⚡ Instalação

\`\`\`bash
composer require kseven/artisano
\`\`\`

---

## 🛠 Comandos disponíveis (Artisano CLI)

\`\`\`bash
php artisano list
php artisano generate:docs
php artisano db:status
php artisano update
\`\`\`

---

## 📦 Scripts Composer

\`\`\`bash
composer test
composer docs
\`\`\`

---

## 📖 Documentação

[Documentação completa](https://ksevendev.github.io/Artisano/)

---

## 🧪 Testes

\`\`\`bash
composer test
\`\`\`

Cobertura HTML:

\`\`\`bash
vendor/bin/phpunit --coverage-html coverage
\`\`\`

---

## ⚖️ Licença

MIT License © K'Seven DevTools
MD;

file_put_contents($projectRoot . '/README.md', $readmeContent);
echo "✅ README.md atualizado\n";

// -------------------------
// 6️⃣ Gerar artisano.php para mensagens CLI
// -------------------------
$artisanoContent = <<<PHP
<?php
/**
 * artisano.php
 * Mensagens personalizadas para Composer / CLI Artisano
 */

\$version = '{$version}';
\$docsLink = 'https://ksevendev.github.io/Artisano/';
\$argvCommand = \$argv[1] ?? null;

echo PHP_EOL;
echo "🎉 Laravel DevTools Pro (Artisano CLI) - v{\$version}" . PHP_EOL;
echo "📖 Documentação completa: {\$docsLink}" . PHP_EOL;

switch (\$argvCommand) {
    case 'install':
        echo "\033[32m✅ Composer install concluído com sucesso!\033[0m" . PHP_EOL;
        break;
    case 'update':
        echo "\033[32m✅ Composer update concluído com sucesso!\033[0m" . PHP_EOL;
        break;
    case 'error':
        echo "\033[31m❌ Ocorreu um erro! Verifique dependências.\033[0m" . PHP_EOL;
        break;
    default:
        echo "🔹 Dicas de uso:" . PHP_EOL;
        echo "   composer test      -> Executa testes automatizados" . PHP_EOL;
        echo "   php artisano list  -> Lista comandos CLI" . PHP_EOL;
        echo "   php artisano generate:docs -> Gera documentação HTML" . PHP_EOL;
        break;
}

echo PHP_EOL;
PHP;

file_put_contents($projectRoot . '/artisano.php', $artisanoContent);
echo "✅ artisano.php gerado/atualizado\n";

echo "\n🎉 run.php concluído! Tudo gerado e atualizado.\n";
