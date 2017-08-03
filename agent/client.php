<?php
define('DEBUG', 'on');
define("WEBPATH", str_replace("\\","/", __DIR__));
require __DIR__ . '/../vendor/swoole_framework/libs/lib_config.php';

$client = new Swoole\Client\WebSocket('127.0.0.1', 9443, '/');
if(!$client->connect())
{
    echo "connect to server failed.\n";
    exit;
}
swoole_timer_tick(1000, function() use($client)
{
    $client->send("hello world #1");
    $message = $client->recv();
    if ($message === false)
    {
        die;
    }
    echo "Received from server: {$message}\n";
});
echo "Closed by server.\n";
