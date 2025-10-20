<?php
require_once __DIR__ . '/dbconnection.php';

class Logger
{
    private static ?Logger $instance = null;
    private mysqli $conn;
    private string $table = 'logs';

    private function __construct()
    {
        $this->conn = DbConnection::getInstance()->getConnection();
    }

    public static function getInstance(): Logger
    {
        if (self::$instance === null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $contextJson = json_encode($context, JSON_UNESCAPED_UNICODE);
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (`level`, `message`, `context`, `created_at`) VALUES (?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param('sss', $level, $message, $contextJson);
            $stmt->execute();
            $stmt->close();
        } 
        // else {
            // fallback para arquivo
            // file_put_contents(__DIR__ . '/../../logs/app.log', "[$level] $message " . $contextJson . PHP_EOL, FILE_APPEND);

        $file = $GLOBALS['LOGS_DIR'] . DIRECTORY_SEPARATOR . 'app.log';
        file_put_contents($file, "[$level] $message " . $contextJson . PHP_EOL, FILE_APPEND | LOCK_EX);
        // }
    }

    private function __clone() {}
    public function __wakeup() {}
}
