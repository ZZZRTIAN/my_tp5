<?php
namespace app\index\model;
use think\Model;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/26
 * Time: 10:01
 */
class User extends Model
{
    // 密码加密
    protected function setPasswordAttr($value){
        return think_ucenter_md5($value, config('UC_AUTH_KEY'));
    }
}
