<?php
namespace app\admin\model;
use think\Model;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/26
 * Time: 10:01
 */
class User extends Model
{
//    protected $table = 'speechx_user';
    /* 用户模型自动完成 */
    protected $auto = ['update_time'];
    protected $insert = ['create_time','headimgurl'=>'/assets/img/user-160x160.jpg'];

    /**
     * 用户登录认证
     * @param  string  $username 用户名
     * @param  string  $password 用户密码
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function login($username, $password){
        /* 获取用户数据 */
        $user = $this->get($username);
        if($user){
            /* 验证用户密码 */
            if(u_md5($password, config('UC_AUTH_KEY')) === $user->password){
                $this->updateLogin($user->id); //更新用户登录信息
                return $user->id; //登录成功，返回用户ID
            } else {
                return -2; //密码错误
            }
        } else {
            return -1; //用户不存在或被禁用
        }
    }

    /**
     * 注册一个新用户
     * @param  string $username     用户名
     * @param  string $password     用户密码
     * @param  string $useremail    用户邮箱
     * @return integer 注册成功-用户信息，注册失败-错误编号
     */
    public function register($username, $password, $useremail){
        $data = array(
            'username' => $username,
            'password' => $password,
            'useremail'    => $useremail,
        );
        /* 添加用户 */
        if($this->validate(true)->save($data)){
            $uid = $this->id;
            return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }

    /**
     * 更新用户登录信息
     * @param  integer $uid 用户ID
     */
    protected function updateLogin($uid){
        $data = array(
            'id'              => $uid,
            'last_login_time' => time()
        );
        $this->update($data);
    }

    // 密码加密
    protected function setPasswordAttr($value){
        return think_ucenter_md5($value, config('UC_AUTH_KEY'));
    }
}
