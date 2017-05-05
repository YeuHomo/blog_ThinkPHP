<?php

namespace Admin\Controller;
use Think\Controller;
use Think\Verify;

class LoginController extends Controller{

    public function index(){
        $this->display();
    }

    public function checkUser(){

        //获取页面post提交的数据
        $username = I('post.username','');
        $password = I('post.password','');
        $code = I('post.code','');

//
//        //校验
//        if($username=='' || $password==''){
////            $this->error('用户名或密码不得为空');
//            setJson(1,"用户名或密码不得为空");
//        }
//
//        if($code == ''){
////            $this->error('验证码不得为空');
//            setJson(2,"验证码不得为空");
//        }
//
//        //校验验证码
//        $verify = new Verify();
//        if(!$verify->check($code)){
//            setJson(3,"校验码错误");
//        }
//

        //连接数据库

        $User = M('User');
        $data['user_name'] = $username;
        $result = $User->where($data)->find();

        //账号是否存在
        if(!$result){
        //    $this->error('账号不存在！');
            setJson(4,"账号不存在！");
        }

        //密码是否正确
        if($result['user_pass'] != md5($password)){
//            $this->error('密码错误！');
            setJson(5,"密码错误");
        }

        //将用户保存到session中
        $_SESSION['admin']=$result;

        //成功
//        $this->success('登录成功','/index.php/Admin/Index');
        setJson(0,"登录成功");
    }



    public function verify(){

        $Verify = new Verify();

        $Verify->fontSize = 30;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }

}