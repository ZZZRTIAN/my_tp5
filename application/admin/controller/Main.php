<?php
/**
 * author: speechx-rtzhang
 * Date: 2017/5/19
 * Time: 9:45
 */
namespace app\admin\controller;
use think\Controller;

class Main extends Controller{

    public function index(){
        return view('index');
    }

}