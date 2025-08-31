<?php
/**
 * run.php - Gera pasta docs com HTML e README.md para Laravel DevTools Pro + Artisano CLI
 */

// ---------------- Configurações ----------------
$docsDir = __DIR__ . '/docs';
@mkdir($docsDir, 0777, true);

// ---------------- README.md --------------------
$readmeContent = <<<MD
# Laravel DevTools Pro

Biblioteca de comandos Laravel + CLI Artisano.

## Instalação

\`\`\`bash
composer require kseven/laravel-devtools
php artisan vendor:publish --tag=devtools-artisano
\`\`\`

## Comandos disponíveis

- db:status
- logs:tail
- logs:watch
- db:faker
- tinker:dev
- make:model
- make:controller
- make:service
- status:app
- cache:clear-all
- routes:list-color
- env:show
- queue:status
- jobs:pending
- test:run
- make:factory
- make:seeder
- make:policy
- make:command
- migrate:refresh-fake
- db:backup
- db:restore
- debug:tables
- session:clear
- user:create
- permission:sync
- storage:link-force
- log:rotate
- composer:update-check

## Configuração

Arquivo \`config/devtools.php\`:

\`\`\`php
return [
    'developer_mode' => env('DEVTOOLS_DEVELOPER', false),
];
\`\`\`

> Somente com \`DEVTOOLS_DEVELOPER=true\` os comandos avançados são executáveis.

## Uso CLI Artisano

\`\`\`bash
php artisano list
php artisano db:status
php artisano logs:watch
php artisano make:model User
\`\`\`
MD;

file_put_contents($docsDir.'/README.md', $readmeContent);

// ---------------- HTML Básico -------------------
$htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Laravel DevTools Pro - Documentação</title>
<style>
body { font-family: Arial, sans-serif; line-height: 1.6; background: #f4f4f4; color: #333; padding: 20px; }
h1,h2,h3 { color: #2c3e50; }
code { background: #eee; padding: 2px 5px; border-radius: 3px; }
pre { background: #eee; padding: 10px; border-radius: 5px; overflow-x: auto; }
table { border-collapse: collapse; width: 100%; margin: 15px 0; }
th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
th { background: #2c3e50; color: #fff; }
tr:nth-child(even){background-color: #f2f2f2;}
</style>
</head>
<body>
<h1>Laravel DevTools Pro</h1>
<p>Biblioteca de comandos Laravel + CLI Artisano.</p>

<h2>Instalação</h2>
<pre><code>composer require kseven/laravel-devtools
php artisan vendor:publish --tag=devtools-artisano</code></pre>

<h2>Comandos disponíveis</h2>
<table>
<tr><th>Comando</th><th>Descrição</th></tr>
<tr><td>db:status</td><td>Mostra status do banco</td></tr>
<tr><td>logs:tail</td><td>Mostra logs em tempo real</td></tr>
<tr><td>logs:watch</td><td>Auto-refresh de logs</td></tr>
<tr><td>db:faker</td><td>Gera dados falsos com Faker</td></tr>
<tr><td>tinker:dev</td><td>Tinker dev com helpers pré-carregados</td></tr>
<tr><td>make:model</td><td>Gera modelo</td></tr>
<tr><td>make:controller</td><td>Gera controller</td></tr>
<tr><td>make:service</td><td>Gera service</td></tr>
<tr><td>status:app</td><td>Status completo da aplicação</td></tr>
<tr><td>cache:clear-all</td><td>Limpa todos caches</td></tr>
<tr><td>routes:list-color</td><td>Lista rotas com cores</td></tr>
<tr><td>env:show</td><td>Mostra variáveis de ambiente</td></tr>
<tr><td>queue:status</td><td>Mostra status das filas</td></tr>
<tr><td>jobs:pending</td><td>Lista jobs pendentes</td></tr>
<tr><td>test:run</td><td>Executa testes automatizados</td></tr>
<tr><td>make:factory</td><td>Gera factory</td></tr>
<tr><td>make:seeder</td><td>Gera seeder</td></tr>
<tr><td>make:policy</td><td>Gera policy</td></tr>
<tr><td>make:command</td><td>Gera comando personalizado</td></tr>
<tr><td>migrate:refresh-fake</td><td>Refresh das migrations com dados fake</td></tr>
<tr><td>db:backup</td><td>Backup do banco de dados</td></tr>
<tr><td>db:restore</td><td>Restaura backup do banco</td></tr>
<tr><td>debug:tables</td><td>Debug de tabelas e status</td></tr>
<tr><td>session:clear</td><td>Limpa sessões</td></tr>
<tr><td>user:create</td><td>Cria usuário via CLI</td></tr>
<tr><td>permission:sync</td><td>Sincroniza permissões</td></tr>
<tr><td>storage:link-force</td><td>Cria link simbólico forçado</td></tr>
<tr><td>log:rotate</td><td>Roda rotação de logs</td></tr>
<tr><td>composer:update-check</td><td>Checa updates de Composer</td></tr>
</table>

<h2>Configuração</h2>
<pre><code>return [
    'developer_mode' => env('DEVTOOLS_DEVELOPER', false),
];</code></pre>
<p>Somente com <code>DEVTOOLS_DEVELOPER=true</code> os comandos avançados são executáveis.</p>

<h2>Uso CLI Artisano</h2>
<pre><code>php artisano list
php artisano db:status
php artisano logs:watch
php artisano make:model User</code></pre>

</body>
</html>
HTML;

file_put_contents($docsDir.'/index.html', $htmlContent);

// ---------------- Conclusão --------------------
echo "✅ Pasta docs/ com README.md e index.html gerados com sucesso!\n";
