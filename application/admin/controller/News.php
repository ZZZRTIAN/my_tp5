<?php
/**
 * author: speechx-rtzhang
 * Date: 2017/5/19
 * Time: 10:59
 */
namespace app\admin\controller;

class News extends Base{

    public function getnewsList(){
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
        if (Request::instance()->isAjax()){
            // 入库

            return ['name'=>'thinkphp','status'=>1];
        }
//        $img_file = file_get_contents($_POST['img']);
//        $img = base64_encode($img_file);
//
//        $image = base64_to_jpeg( $img, 'tmp.jpg' );
         // ajax请求才有
        return $this->error('错误。。不是ajax请求','news');
    }

    /**
     * 上传文本中的图片     （内容图片）
     */
    public function uploadImg(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('textImage');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
//            // 成功上传后 获取上传信息
//            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
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
        $title = 'this is title!!';
        $date = '2017-05-20';
        $abstract = 'xczcasd asfdcsdf xcv xcv xcw sdf sxcv xcv er r';
        $content = "<p>asdasdasd<img style='width: 300px;' src='/uploads/20170525/bf5a7897f3b2ec3250994172acda40c4.jpg' /></p>";
        return array('title'=>$title,'date'=>$date,'abstract'=>$abstract,'content'=>$content);
    }


    /**
     * 上传标题下显示的图片 （大图）
     */
    private function uploadBigImg(){
        $img_file = file_get_contents($_POST['img']);
        $img = $this->base64_encode($img_file);
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