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
    // http://www.speechx_tp.com/index.php/hello/1
    // 伪静态解决   ->  http://www.speechx_tp.com/hello/1
    'admin/news/newsForm/[:newsId]'      =>  'admin/news/newsForm', // [ 可选 ]
    'admin/news/editNews/:id'            =>  'admin/news/editNews',

    'news/[:page]'          => 'index/index/getNews',        // 查询
    'addViews/:id'  => 'index/index/addViews'    // 添加浏览量
];