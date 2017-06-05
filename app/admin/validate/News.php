<?php
namespace app\admin\validate;
use think\Validate;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/25
 * Time: 14:05
 */
class News extends Validate
{
    protected $rule = [
        // 验证当前请求的字段值是否为唯一的，例如：unique:user require后验证 |左右不能有空格
        'title'     =>  'require|length:1,32|unique:news',
        'author'    =>  'require|length:1,32',
        'content'   =>  'require'
    ];

    protected $message = [
        'title.require'   => '标题不能为空',
        'title.unique'    => '该标题已存在',
        'title.length'    => '标题长度不合法',
        'content.require' => '内容不得为空',
    ];


}