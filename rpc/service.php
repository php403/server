<?php
/**
 *  Created by httpServer
 *  User: pg
 *  Date: 2020-07-14
 **/

class service
{
    public static function getUserInfo($uid){
        return [
            'id' => $uid,
            'username' => 'pg'
        ];
    }
}

$service = $_GET['service'];
$action = $_GET['action'];
$argv = file_get_contents("php://input");

if($argv){
    $argv = json_decode($argv);
}

$res = call_user_func_array([$service,$action],$argv);

echo json_encode($res);