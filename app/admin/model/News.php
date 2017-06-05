<?php
namespace app\admin\model;
use think\Model;

class News extends Model
{
    // 设置当前模型对应的完整数据表名称
//    protected $table = 'speechx_news';
    // 数据自动完成指在不需要手动赋值的情况下对字段的值进行处理后写入数据库。
    protected $auto = ['update_time'];
    protected $insert = ['create_time','views'=>0];

    // 添加新闻
    public function toAddNews($data){
        /* 添加新闻 */
        if($this->validate(true)->save($data)){
            return $this->id; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }

    // 请求的 ip 地址
    protected function setIpAttr()
    {
        return request()->ip();
    }

   
}
?>