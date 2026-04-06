<?php
function dd(...$vars){
    echo "<pre style='background-color: rgb(243, 243, 243); color:rgb(14, 14, 14); padding: 10px; margin: 10px; border-radius: 5px; font-family: monospace;'>";
    echo "<strong>Debug Output</strong><br>";
    
    foreach($vars as $var){
        echo "<pre style='background-color: #bec0c2; color: #000; padding: 10px; margin: 10px; border-radius: 5px; font-family: monospace;'>";
        var_dump($var);
        echo "</pre>";
    }
    $backtrace = debug_backtrace()[0];
    $arquivo = $backtrace['file'];
    $linha = $backtrace['line'];
    echo "<pre>";

        echo "<strong>Arquivo:</strong> $arquivo<br>";
        echo "<strong>Linha:</strong> $linha<br>";

    echo "</pre>";
    echo "</pre>";
    die();
}

function config($key, $default = NULL){
    static $config = NULL;

    if(empty($config)){
        $config = require __DIR__ .'/../config/config.php';
    }
    return $config[$key] ?? $default;
}