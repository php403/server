<?php
/**
 *  Created by httpServer
 *  User: pg
 *  Date: 2020-07-10
 **/
require_once "Workerman/Autoloader.php";

$ws_worker = new \Workerman\Worker('tcp://0.0.0.0:2346');

// 4 processes
$ws_worker->count = 4;

// Emitted when new connection come
$ws_worker->onConnect = function ($connection) {
    echo "New connection\n";
};

// Emitted when data received
$ws_worker->onMessage = function ($connection, $data) {
    // Send hello $data
    $connection->send('Hello ' . $data);
};

// Emitted when connection closed
$ws_worker->onClose = function ($connection) {
    echo "Connection closed\n";
};

// Run worker
\Workerman\Worker::runAll();

/*$clients = array();
$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
socket_bind($socket,'127.0.0.1','8080');
socket_listen($socket,100);
socket_set_nonblock($socket);
while(true){
    if($acp = socket_accept($socket) !== false){
        echo "client {$acp} has connected".PHP_EOL;
        socket_write($socket,"content-type: application/json; charset=utf-8\n\rstatus: 200\n\r");
    }
}*/
