<?php
namespace App\Traits;
trait LoggerTrait
{
    protected function log($error_msg, $level = 'INFO')
    {
        $date = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'IP_DESCONHECIDO';
        $log_entry = "[$date] [$level] [IP: $ip] - $error_msg". PHP_EOL;
        $log_file = __DIR__ . '/../logs/system.log';
        \file_put_contents($log_file, $log_entry, \FILE_APPEND);
        // PHP_EOL é pra fazer uma quebra de linha universal em arquivo de texto
    }
}