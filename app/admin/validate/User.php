<?php
namespace app\admin\validate;
use think\Validate;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/25
 * Time: 14:05
 */
class User extends Validate
{
    protected $rule = [
        // 验证当前请求的字段值是否为唯一的，例如：unique:表名
        'username'=>'length:1,30|unique:',
        'email'=>'email|length:1,32|unique:',
    ];

    protected $message = [
        'username.length'=>'用户名长度不合法',
        'username.unique'=>'用户名被占用',
        'email.email'=>'邮箱格式错误',
        'email.length'=>'邮箱长度不合法',
        'email.unique'=>'邮箱被占用',
    ];


}