<?php
namespace app\index\controller;
use think\Db;
class Index
{

    public function getNews($page = null){
        if ($page){
            $data = Db::name('news')
                        ->field('author,title,b_img,abstract,content,views')
                        ->where('state',1)
                        ->order('publish_time desc')
                        ->limit(($page-1)*8,8)
                        ->select();
        }else{
            $data = Db::name('news')
                ->field('author,title,b_img,abstract,content,views')
                ->where('state',1)
                ->order('publish_time desc')
                ->select();
        }
//        $arr['count'] = ;
        $arr['result'] = $data;
        return json($arr);
    }

    public function addViews($id){
        // views 字段加 1
        Db::name('news')
            ->where('id', $id)
            ->setInc('views');
    }
	
}
