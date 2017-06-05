<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use \think\Log;

class Base extends Controller{

    //初始化方法   登录验证  和  初始化左侧菜单
    public function _initialize(){
        // 写日志
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH.'logs/'
        ]);

        // 判断是否登录，没有登录跳转登录页面
//        if(!session('user_auth') || !session('user_auth_sign')){
//            $this->redirect('index/index');
//        }
        // 面包屑
        $dispatch = $this->request->dispatch();
        $activeRouter = $dispatch['module']['0'] . '/' . $dispatch['module'][1] . '/' . $dispatch['module'][2];
        $this->assign('uri', $activeRouter);

        // 传递菜单

        // 传递用户信息
        $uid = session('user_auth')['uid'];
        $umessage = Db::name('user')->field('username,headimgurl')->where('id',$uid)->find();
        $this->assign($umessage);
    }

    /**
     * 获取用户拥有的菜单
     */
    protected function getSidebar(){

    }


}

?>