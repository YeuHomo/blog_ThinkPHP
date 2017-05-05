<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/Public/Admin/style/font/css/font-awesome.min.css">
</head>
<body style="background:#F3F3F4;">
<div class="login_box">
    <h1>Blog</h1>
    <h2>欢迎使用博客管理平台</h2>
    <div class="form">
        <form action="" method="post">
            <ul>
                <li>
                    <input type="text" id="username" name="username" class="text"/>
                    <span><i class="fa fa-user"></i></span>
                </li>
                <li>
                    <input type="password" id="password" name="password" class="text"/>
                    <span><i class="fa fa-lock"></i></span>
                </li>
                <li>
                    <input type="text" class="code" id='code' name="code"/>
                    <span><i class="fa fa-check-square-o"></i></span>
                    <img src="/index.php/admin/login/verify" alt="" id='verify' onclick="this.src='/index.php/admin/login/verify?'+Math.random()">
                </li>
                <li>
                    <input type="button" onclick="login.check()" value="立即登陆"/>
                </li>
            </ul>
        </form>
        <p><a href="#">返回首页</a> &copy; 2016 Powered by <a href="http://www.houdunwang.com" target="_blank">http://www.houdunwang.com</a></p>
    </div>
</div>
</body>

</html>
<script src="/Application/Common/JS/jquery.js"></script>
<script src="/Application/Common/JS/layer.js"></script>
<script src="/Public/Admin/style/js/dialog.js"></script>
<script src="/Public/Admin/style/js/login.js"></script>