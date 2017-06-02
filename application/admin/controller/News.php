<?php
/**
 * author: speechx-rtzhang
 * Date: 2017/5/19
 * Time: 10:59
 */
namespace app\admin\controller;
use app\admin\model\News as NewsModel;
use think\Db;

class News extends Base{

    //如果需要过滤非数据表字段的数据，可以使用：
    //
    //$user = new User($_POST);
    //// 过滤post数组中的非数据表字段数据
    //$user->allowField(true)->save();

    public function newsList(){
        $count = Db::name('news')->count();
        $data = Db::name('news')
            ->order('publish_time desc')
            ->paginate(10);
        $this->assign('list',$data);
        $this->assign('count',$count);
        return view('list');
    }

    public function newsForm($newsId=null){
        // 修改 -> 传了id
        if (isset($newsId) && preg_match("/^\d*$/",$newsId)){   // 识别只有数字的
            //根据id获得信息
            $this->assign('newsId',$newsId);
        }else{
            $this->assign('newsId',null);
        }
        return view('form');
    }

    /**
     * 添加新闻到数据库
     */
    public function addNews(){
        if(request()->isPost() && input('post.')){
            // 启动事务
            Db::startTrans();
            try{
                $data = input('post.');
                $newsModel = new NewsModel();
                $data['b_img'] = $this->uploadBigImg($data['b_img']);
                $newsModel->toAddNews($data);
                // 提交事务
                Db::commit();
                // ajax请求才有
                return ['result'=>1];
            } catch (\Exception $e) {
//                // 回滚事务
                Db::rollback();
                return ['result'=>0];
            }
        }else{
            return view('form');
        }
    }
    
    /**
     * 发布状态改变
     */
    public function changeState($id,$state){
        Db::name('news')
            ->where('id', $id)
            ->update([
                'state'  => $state
            ]);
    }

    /**
     * 上传文本中的图片     （内容图片）
     */
    public function uploadImg(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('textImage');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['ext'=>'jpg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $imgPath = str_replace('\\', '/', $info->getSaveName());  //  \ -> /
            return '/uploads' . DS . $imgPath;
        }
        return '';
    }

    /**
     * 新闻列表点击修改时
     * @param $id       新闻id
     * @return mixed
     */
    public function editNews($id){
//        if(request()->isPost() && input('post.')){
//            $id = input('?post.id') ? input('post.id') : '';
//            if(!$id || $id==1){
//                return $this->error('参数错误');
//            }
//            $data = ['username'=>input('post.username')];
//        }
        $title = 'this is title!!'.$id;
        $date = '2017-05-20';
        $abstract = 'xczcasd asfdcsdf xcv xcv xcw sdf sxcv xcv er r';
        $content = "<p>asdasdasd<img style='width: 300px;' src='/uploads/20170525/bf5a7897f3b2ec3250994172acda40c4.jpg' /></p>";
        return ['title'=>$title,'date'=>$date,'abstract'=>$abstract,'content'=>$content];
    }

    /**
     * 上传标题下显示的图片 （大图）
     * @param $imgdata  二进制
     * @return mixed    图片路径
     */
    private function uploadBigImg($imgdata){
        $img_file = file_get_contents($imgdata);
        $img = base64_encode($img_file);

        return $this->base64_to_jpeg( $img, ROOT_PATH . 'public' . DS . 'uploads' . DS . md5(uniqid(rand())).'.jpg' );
    }

    /**
     * 转换成图片 要砍掉前面的data:image/png;base64,（如果有的话）
     * @param $base64_string    base64字符串
     * @param $output_file      要保存到的路径
     * @return mixed 图片路径
     */
    private function base64_to_jpeg( $base64_string, $output_file ) {
        $ifp = fopen( $output_file, "wb" );
        fwrite( $ifp, base64_decode( $base64_string) );
        fclose( $ifp );
        return( $output_file );
    }
    

}