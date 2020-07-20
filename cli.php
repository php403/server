<?php
/**
 *  Created by httpServer
 *  User: pg
 *  Date: 2020-07-14
 **/

$client = stream_socket_client("unix://http.sock",$errno,$errstr);

if (!$client)
{
    die("connect to server fail: $errno - $errstr");
}

while(1)
{
    $msg = fread(STDIN, 1024);

    if ($msg == "quit\n")
    {
        break;
    }

    fwrite($client, $msg);
    $rt = fread($client, 1024);

    echo $rt . "\n";
}

fclose($client);