<?php
namespace app\index\model;

use think\Model;

class News extends Model
{
		//发布状态
	const IS_PUBLISH = 1;
	//未发布状态
	const IS_DRAFT = 0;

	// 设置当前模型对应的完整数据表名称
    protected $table = 'speechx_news';

    public function get123(){
    	return '123';
    }

    //
    public function getNews(){

    }

}
?>