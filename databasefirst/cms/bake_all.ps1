# bake_all.ps1
# Roda `php bin\cake bake all <table>` para todas as tabelas do banco (sem excluir nenhuma)
# Ajuste: $mysqlPath, $phpExe, $db, $dbUser, $dbPass, $stopOnError

# $mysqlPath = "C:\xampp\mysql\bin\mysql.exe"   # caminho do cliente mysql (XAMPP). Ajuste se necessário
$mysqlPath = "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe"
# C:\Program Files\MySQL\MySQL Server 8.0\bin
$phpExe    = "php"                            # usa php do PATH
$db        = "restaurant_db"                      # <<-- coloque o nome do seu DB
$dbUser    = "root"                           # <<-- seu usuário
$dbPass    = "PUC@1234"                               # <<-- sua senha (se houver, coloque-a aqui)

$stopOnError = $false                         # true => para ao primeiro erro; false => continua

Write-Host "Iniciando bake para todas as tabelas do DB '$db'..."
if (-not (Test-Path $mysqlPath)) {
    Write-Error "mysql.exe nao encontrado em: $mysqlPath. Ajuste a variavel \$mysqlPath no script."
    exit 1
}

# montar argumentos para mysql.exe conforme se ha senha ou nao
$args = @('-u', $dbUser)
if ($dbPass -ne '') { $args += "-p$dbPass" }
$args += @('-N', '-e', "SHOW TABLES FROM $db;")

# executar mysql para listar tabelas
$tOut = & $mysqlPath @args 2>$null
if ($LASTEXITCODE -ne 0 -or [string]::IsNullOrWhiteSpace($tOut)) {
    Write-Error "Falha ao listar tabelas. Verifique credenciais, existencia do DB e o caminho do mysql.exe."
    exit 1
}

$tables = $tOut -split "`n" | ForEach-Object { $_.Trim() } | Where-Object { $_ -ne "" }
if ($tables.Count -eq 0) {
    Write-Host "Nenhuma tabela encontrada em $db. Saindo."
    exit 0
}

# limpar schema cache (opcional, recomendavel)
Write-Host "Limpando schema cache..."
& $phpExe bin\cake.php schema_cache clear --connection default

$errors = @()

foreach ($t in $tables) {
    Write-Host "=== Baking table: $t ==="
    & $phpExe bin\cake.php bake all $t
    $code = $LASTEXITCODE
    if ($code -ne 0) {
        $msg = "Bake falhou para tabela $t (exit code $code)."
        Write-Warning $msg
        $errors += $msg
        if ($stopOnError) { break }
    } else {
        Write-Host "Bake OK para: $t"
    }
}

# rebuild schema cache no final
Write-Host "Reconstruindo schema cache..."
& $phpExe bin\cake.php schema_cache build --connection default

Write-Host "=== Concluido ==="
if ($errors.Count -gt 0) {
    Write-Warning "Houveram erros em $($errors.Count) tabela(s). Veja mensagens acima."
    $errors | ForEach-Object { Write-Host $_ }
} else {
    Write-Host "Todas as tabelas processadas (sem erros reportados)."
}