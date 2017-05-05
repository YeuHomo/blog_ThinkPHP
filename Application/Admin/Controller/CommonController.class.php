<?php

namespace Admin\Controller;

use Think\Controller;


class CommonController extends Controller{

    public function _initialize(){

        if($_SESSION['admin']==''){

          return redirect('/index.php/Admin/login/index');
        }

    }


}