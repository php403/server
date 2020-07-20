<?php
/**
 *  Created by httpServer
 *  User: pg
 *  Date: 2020-07-10
 **/

$socket_file = "http.sock";

if(file_exists($socket_file)){
    unlink($socket_file);
}

$server = stream_socket_server("unix://{$socket_file}",$errno,$errstr);
if(!$server){
    exit("创建sock失败");
}
//$client = stream_socket_client('tcp://127.0.0.1:9000');
while(1){
    $conn = stream_socket_accept($server,100);
    if($conn){
        while(1){
            $msg = fread($conn,2048);
            if(strlen($msg) == 0){
                fclose($conn);
                break;
            }
            //stream_copy_to_stream($server,$client);
            var_dump($msg);
            echo "-----------------------------------------------";
        }
    }
}
fclose($server);