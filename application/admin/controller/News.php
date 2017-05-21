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

    public function addNews(){
    	$dispatch = $this->request->dispatch();
		$activeRouter = $dispatch['module']['0'] . '/' . $dispatch['module'][1] . '/' . $dispatch['module'][2];
		$this->assign('uri', $activeRouter);
        return view('form');
    }

}