<?php
namespace app\index\controller;
use think\controller\Rest;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/25
 * Time: 11:24
 */
class News extends Rest{
    public function rest(){
        switch ($this->method){
            case 'get': // get请求处理代码
                if ($this->type == 'html'){
                } elseif ($this->type == 'xml'){
                }
                break;
            case 'put': // put请求处理代码
                break;
            case 'post': // post请求处理代码
                break;
        }
    }

}