<?php
// build-phar.php
$pharFile = __DIR__ . '/php/packages/classes.phar';

// Apaga se já existir
if (file_exists($pharFile)) {
    unlink($pharFile); //apaga se já existir
}

//cria o arquivo
$phar = new Phar($pharFile);

//adiciona todos os arquivos .php da pasta php/classes/
$phar->buildFromDirectory(__DIR__ . '/php/classes', '/\.php$/');

//define o stub (o código inicial que o .phar executa)
// $stub = <<<'STUB'
// <?php
// Phar::mapPhar('classes.phar');
// require 'phar://classes.phar/autoload.php';
// __HALT_COMPILER();
// STUB;
$stub = <<<'STUB'
<?php
Phar::mapPhar();
require 'phar://' . basename(__FILE__) . '/autoload.php';
__HALT_COMPILER();
STUB;

$phar->setStub($stub);

// FALLBACK adiciona um autoloader simples dentro do phar
// $autoload = "<?php\n";
// $autoload .= "spl_autoload_register(function(\$class) {\n";
// $autoload .= "    \$file = 'phar://classes.phar/' . basename(str_replace('\\\\', '/', \$class)) . '.php';\n";
// $autoload .= "    if (file_exists(\$file)) require \$file;\n";
// $autoload .= "});\n";
// $phar->addFromString('autoload.php', $autoload);
$autoload = "<?php\n";
$autoload .= "spl_autoload_register(function(\$class) {\n";
$autoload .= "    \$file = 'phar://' . basename(__FILE__) . '/' . basename(str_replace('\\\\', '/', \$class)) . '.php';\n";
$autoload .= "    if (file_exists(\$file)) require \$file;\n";
$autoload .= "});\n";
$phar->addFromString('autoload.php', $autoload);

echo "Arquivo 'classes.phar' criado com sucesso!\n";
