<?php
/**
 *  Created by httpServer
 *  User: pg
 *  Date: 2020-07-14
 **/

class main
{
    private $url;
    private $service;

    private $rpcConfig = [
        'UserService' => "http://127.0.0.1:9501"
    ];

    public function __construct($service)
    {
        if(array_key_exists($service,$this->rpcConfig)){
            $this->url = $this->rpcConfig[$service];
            $this->service = $service;
        }
    }


    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        $content = json_encode($arguments);
        $options['http'] = [
            'timeout' => 5,
            'method' => "POST",
            'header' => '',
            'content' => $content
        ];

        $content = stream_context_create($options);
        $get = [
            'service' => $this->service,
            'action' => $name
        ];
        $url = $this->url."?".http_build_query($get);
        echo $url.PHP_EOL;
        $res = file_get_contents($url,false,$content);
        return json_decode($res,true);
    }
}