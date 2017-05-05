<?php
namespace Admin\Controller;

class IndexController extends CommonController {
    public function index(){
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this->display();
    }
    public function info(){
        $this->display();
    }

    public function logout(){
        $_SESSION['admin'] =null;
        return redirect('/index.php/Admin/Login/index');
    }

    public function passChange(){
         $password_o = $_POST['password_o'];
         $password = $_POST['password'];

         if(md5($password_o) != $_SESSION['admin']['user_pass']){
             setJson(1,"原密码错误");
         }

        $data = $_SESSION['admin'];
        $_SESSION['admin']['user_pass'] = md5($password);


         $User = M('User');
         $User->where($data)->save($_SESSION['admin']);
         setJson(0,"修改密码成功");

         $this->display();

    }

}