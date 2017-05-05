var pass = {

    check:function () {

        var password_o = $('#password_o').val();
        var password = $('#password').val();
        var password_c = $('#password_c').val();

        if(password_o.length==0){
            return dialog.error("请输入原密码！");
        }
        if(password.length==0 || password_c.length==0){
            return dialog.error("请输入新密码或确认密码！");
        }

        if(password!=password_c){
            return dialog.error("新密码和确认密码必须一致！");
        }

        if(password_o == password){
            return dialog.error("新密码不可以和原密码一样！");
        }

        if(password.length<6){
            return dialog.error("新密码不可以少于6位！");
        }

        var url = '/Admin/Index/passChange';
        var data = {'password_o':password_o,'password':password};

        $.post(url,data,function (data) {

            if(data.status != 0){
                dialog.error(data.message);
                return ;
            }
            dialog.outSuccess(data.message,"/index.php/Admin/Login/index");
        },'JSON');

    }

};