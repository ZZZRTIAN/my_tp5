<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller{

    //初始化方法   登录验证  和  初始化左侧菜单
    public function _initialize(){

    }

    /**
     * 获取菜单
     */
    protected function getSidebar(){

    }
}

?>