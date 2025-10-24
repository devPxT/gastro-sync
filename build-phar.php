<?php
// build-phar.php
// Gera um arquivo .phar contendo todas as classes em php/classes/

$pharFile = __DIR__ . '/classes.phar';

// Apaga se já existir
if (file_exists($pharFile)) {
    unlink($pharFile);
}

// Cria o Phar
$phar = new Phar($pharFile);

// Adiciona todos os arquivos .php da pasta php/classes/
$phar->buildFromDirectory(__DIR__ . '/php/classes', '/\.php$/');

// Define o stub (o código inicial que o .phar executa)
$stub = <<<'STUB'
<?php
Phar::mapPhar('classes.phar');
require 'phar://classes.phar/autoload.php';
__HALT_COMPILER();
STUB;

$phar->setStub($stub);

// Opcional: adiciona um autoloader simples dentro do phar
$autoload = "<?php\n";
$autoload .= "spl_autoload_register(function(\$class) {\n";
$autoload .= "    \$file = 'phar://classes.phar/' . basename(str_replace('\\\\', '/', \$class)) . '.php';\n";
$autoload .= "    if (file_exists(\$file)) require \$file;\n";
$autoload .= "});\n";
$phar->addFromString('autoload.php', $autoload);

echo "✅ Arquivo 'classes.phar' criado com sucesso!\n";
