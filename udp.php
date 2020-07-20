<?php
/**
 *  Created by httpServer
 *  User: pg
 *  Date: 2020-07-20
 **/



$upd = "udp://127.0.0.1:9999";
$socket = stream_socket_server($upd,$error,$errstr,STREAM_SERVER_BIND);
if(!$socket){
    throw new Exception('连接失败');
}
for ($i=0;$i<=10;$i++){
    $pid = pcntl_fork();
    if($pid ==0){
        while (true){
            if($msg = stream_socket_recvfrom($socket,1024,0,$addRess)){
                echo "msg:".$msg.PHP_EOL;
                echo "client:".$addRess.PHP_EOL;
                stream_socket_sendto($socket,"recv_time:".date('Y-m-d H:i:s').PHP_EOL,0,$addRess);
            }
            sleep(1);
        }
    }
    if($pid>0){

        var_dump($pid);
    }

    //增加管道 子进程输出重定向到父进程
}
