<?php
// +----------------------------------------------------------------------
// | Author: pg719 <pg719@qq.com>
// +----------------------------------------------------------------------

namespace app\controller;


use app\model\UserInfo;
use app\service\ReturnCommon;

class Pet extends BaseController
{
    public $url = "http://pet.demo.huihuile.cn";

    public function petLogin(){
        $res = $this->client->request('get',$this->url."/UserController/login?token={$this->token}",['token'=>$this->token]);
        return $res->getBody();
    }

    public function upPetLevel(){
        $pet_code = $this->request->get('pet_code');
        $price = $this->request->get('price');
        $user_price = (new UserInfo())->getUserInfoValue($this->token,'gold');
        if($user_price < $price){
            return $this->returnJson('金币不足',ReturnCommon::$error);
        }
        $res = $this->client->request('get',$this->url."/UserController/upPetLevel?token={$this->token}&pet_code={$pet_code}",['token'=>$this->token,'pet_code'=>$pet_code]);
        if(json_decode($res->getBody(),true)['code'] == 0 && $price>0){
            $bool = (new UserInfo())->editUserInfo($this->token,'gold',"- {$price}");
        }
        return $res->getBody();
    }

    public function getPetLevelList(){
        $res = $this->client->request('get',$this->url."/UserController/getPetLevelList?token={$this->token}",['token'=>$this->token]);
        return $res->getBody();
    }

    public function selectPet(){
        $pet_code = $this->request->get('pet_code');
        $res = $this->client->request('get',$this->url."/UserController/selectPet?token={$this->token}&pet_code={$pet_code}",['token'=>$this->token,'pet_code'=>$pet_code]);
        return $res->getBody();
    }
}