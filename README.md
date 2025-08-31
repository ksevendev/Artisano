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