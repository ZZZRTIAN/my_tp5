<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '/'             =>  'index',
    'hello/:name'   =>  'admin/Index/hello',
    // http://www.speechx_tp.com/index.php/hello/1
    // 伪静态解决   ->  http://www.speechx_tp.com/hello/1
    'main'          =>  'admin/Main/index',
    'news'          =>  'admin/News/getnewsList',
    'newsForm'      =>  'admin/News/newsForm',
    'addNews'       =>  'admin/News/addNews',

    'getNewsInfo'       =>  'index/Index/getNewsInfo'

];