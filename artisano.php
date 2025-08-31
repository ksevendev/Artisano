<?php
/**
 * artisano.php
 * Mensagens personalizadas para Composer / CLI Artisano
 */

$version = '2.0.1';
$docsLink = 'https://ksevendev.github.io/Artisano/';
$argvCommand = $argv[1] ?? null;

echo PHP_EOL;

// Mensagem genérica
echo "🎉 Laravel DevTools Pro (Artisano CLI) - v{$version}" . PHP_EOL;
echo "📖 Documentação completa: {$docsLink}" . PHP_EOL;

// Mensagens específicas por comando do Composer
switch ($argvCommand) {
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
        break;
}

echo PHP_EOL;
