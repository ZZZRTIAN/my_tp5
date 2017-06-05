<?php
namespace app\admin\controller;
use app\admin\model\User;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        // 检测登录状态
        if(session('user_auth') && session('user_auth_sign')){
            $this->redirect('main/index');
        }
        if(request()->isPost() && input('post.')){
            $useremail = input('post.useremail');
            $password = input('post.password');

            if(!$useremail || !$password){
                return $this->error('请填正确的写用户名或密码');
            }
            $user = new UserModel();
            $uid = $user->login($useremail,$password);
            if( $uid > 0 ){
                /*记录session和cookie*/
//                $group_id = \think\Db::table('auth_group_access')->field('group_id')->where('uid',$uid)->find();
                $auth = [
                    'uid'=>$uid,                        // 用户id
//                    'group_id'=>$group_id['group_id'],  // 组id 1为超级管理员 当前拥有权限级别
                    'username'=>$useremail,              // 用户名
                    'last_login_time'=>time(),
                ];
                session('user_auth',$auth);
                session('user_auth_sign', data_auth_sign($auth));
                return $this->success('登录成功','main/index');
            }else{
                switch ($uid) {
                    case '-1':
                        $error = '用户不存在';
                        break;
                    case '-2':
                        $error = '密码错误';
                        break;
                    default:
                        $error = '未知错误';
                        break;
                }
                return $this->error($error);
            }
        }else{
            return view('login');
        }
    }

    public function register(){
        $user = new User();
        dump($user);
//        $user->register('admin','123','rtzhang@speechx.cn');
    }
	
}
