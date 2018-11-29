<?php
namespace app\lib;
use application;




class RequestHandle{
    public  $app;


    function __construct(application $app){
        $this->app=$app;
    }

    public function  handle(){
        $this->ParseServer();
    }


    private function  ParseServer(){
        $route=[
            'index/index'=>'\app\controller\webApi\v3\IndexController@index',
        ];
        $request=new \app\lib\Request();
        $url=$request->url();
        if($url!='/'){
            if(isset($route[$url])){
                $list=explode('@',$route[$url]);
                if(method_exists($list[0],$list[1])){
                    $controller=new $list[0]();
                    $result=$controller->index($request);
                    var_dump($result);
                }


            }else{

            }
        }
    }

}