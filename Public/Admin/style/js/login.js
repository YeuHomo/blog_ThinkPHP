var login = {


    check: function() {

        var username = $('#username').val();
        var password = $('#password').val();
        var code = $('#code').val();

        // //校验
        // if (username.length == 0 || password.length == 0) {
        //     return dialog.error('用户名和密码不得为空');
        // }
        //
        // if (code.length == 0) {
        //     return dialog.error('验证码不得为空');
        // }


        var url='/Admin/Login/checkUser';
        var data = {'username':username,'password':password,'code':code};

        $.post(url,data,function (data) {
           if(data.status !=0){
               dialog.error(data.message);
               document.getElementById("verify").click();
               return ;
           }
            dialog.success(data.message,'/index.php/Admin/Index/index');

        },'JSON');

    }

};