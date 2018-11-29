<?php
namespace app\controller\webApi\v3;
use app\controller\controller;
use app\lib\Request;

class IndexController extends controller{


    function index(Request $request){
       return ['code'=>1001,'msg'=>'success'];
    }


}