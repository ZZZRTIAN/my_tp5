<?php
namespace app\admin\controller;
use think\Controller;

class Base extends Controller{

    //初始化方法   登录验证  和  初始化左侧菜单
    public function _initialize(){
        // 面包屑
        $dispatch = $this->request->dispatch();
        $activeRouter = $dispatch['module']['0'] . '/' . $dispatch['module'][1] . '/' . $dispatch['module'][2];
        $this->assign('uri', $activeRouter);
    }

    /**
     * 获取菜单
     */
    protected function getSidebar(){

    }
}

?>