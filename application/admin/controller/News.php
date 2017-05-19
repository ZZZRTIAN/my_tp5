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
        return view('form');
    }

}