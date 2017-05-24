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

    public function newsForm(){
    	$dispatch = $this->request->dispatch();
		$activeRouter = $dispatch['module']['0'] . '/' . $dispatch['module'][1] . '/' . $dispatch['module'][2];
		$this->assign('uri', $activeRouter);
        return view('form');
    }

    /**
     * 添加新闻到数据库
     */
    public function addNews(){
        $img_file = file_get_contents($_POST['img']);
        $img = base64_encode($img_file);

        $image = base64_to_jpeg( $img, 'tmp.jpg' );
    }

    /**
     * 上传文本中的图片     （内容图片）
     */
    public function uploadImg(){
        // 获取表单上传文件 例如上传了001.jpg
        $files = request()->file('textImage');
        // 移动到框架应用根目录/public/uploads/ 目录下
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $files->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $info->getError();
        }

//        foreach($files as $file){
//            // 移动到框架应用根目录/public/uploads/ 目录下
//            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
//            if($info){
//                // 成功上传后 获取上传信息
//                // 输出 jpg
//                echo $info->getExtension();
//                // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                echo $info->getFilename();
//            }else{
//                // 上传失败获取错误信息
//                echo $file->getError();
//            }
//        }
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