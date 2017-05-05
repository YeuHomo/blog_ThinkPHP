<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/Application/Common/JS/jquery.js"></script>


</head>
<body>
    <form action="/index.php/Admin/Img/upload" enctype="multipart/form-data" method="post" >
    <input type="text" name="name" />
    <input type="file" name="photo" id="photo" onchange="_changeImg()"/>
        <img src="/Public/images/130.jpg" id="imgView">
    <input type="submit" value="提交" >
</form>
</body>
</html>
<script>


    function getPath(obj)
    {
        var imgURL = "";
        try{
            var file = null;
            if(node.files && node.files[0] ){
                file = node.files[0];
            }else if(node.files && node.files.item(0)) {
                file = node.files.item(0);
            }
            //Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径
            try{
                //Firefox7.0
                imgURL =  file.getAsDataURL();
                //alert("//Firefox7.0"+imgRUL);
            }catch(e){
                //Firefox8.0以上
                imgURL = window.URL.createObjectURL(file);
                //alert("//Firefox8.0以上"+imgRUL);
            }
        }catch(e){      //这里不知道怎么处理了，如果是遨游的话会报这个异常
            //支持html5的浏览器,比如高版本的firefox、chrome、ie10
            if (node.files && node.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgURL = e.target.result;
                };
                reader.readAsDataURL(node.files[0]);
            }
        }
        return imgURL;
    }
    }

    function _changeImg() {

        var path = getPath($('#photo').val());
        alert(path);
//        var name = path.substring(path.lastIndexOf('\\') + 1);
        $('#imgView').attr('src',path);
    }

</script>