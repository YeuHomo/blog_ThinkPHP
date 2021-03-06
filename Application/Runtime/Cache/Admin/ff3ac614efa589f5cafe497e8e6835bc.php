<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/Public/Admin/style/font/css/font-awesome.min.css">
    <script src="/Application/Common/JS/jquery.js"></script>
    <script src="/Public/Admin/style/js/dialog.js"></script>
    <script src="/Application/Common/JS/layer.js"></script>
</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="#"><i class="fa fa-plus"></i>新增文章</a>
            <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
            <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="" method="post" id="form1">
        <table class="add_tab">
            <tbody>
            <tr>
                <th>标题编号：</th>
                <td>
                    <input type="text" name="art_id" value="<?php echo ($list["art_id"]); ?>" readonly>
                </td>
            </tr>
            <tr>
                <th width="120"><i class="require">*</i>分类：</th>
                <td>
                    <select name="cate_id">
                        <option value="">==请选择==</option>
                        <?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i; if($list['cate_id'] == $cate['cate_id']): ?><option value="<?php echo ($cate["cate_id"]); ?>" selected><?php echo ($cate["cate_name"]); ?></option>
                                <?php else: ?>
                                <option value="<?php echo ($cate["cate_id"]); ?>"><?php echo ($cate["cate_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>

                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>标题：</th>
                <td>
                    <input type="text" class="lg" name="art_title" value="<?php echo ($list["art_title"]); ?>">
                </td>
            </tr>
            <tr>
                <th>作者：</th>
                <td>
                    <input type="text" name="art_editor" value="<?php echo ($list["art_editor"]); ?>">
                </td>
            </tr>


            <tr>
                <th>缩略图：</th>
                <td>
                    <input type="text" size="50" name="art_thumb" value="<?php echo $data['art_thumb']?>" readonly>
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                    <script src="/Public/Admin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="/Public/Admin/uploadify/uploadify.css">
                    <script type="text/javascript">
                        <?php echo ($timestamp = time()); ?>;
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText' : '图片上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    'token'     : "<?php echo md5('unique_salt' . $timestamp);?>"
                                },
                                'swf'      : "/Public/Admin/uploadify/uploadify.swf",
                                'uploader' : "/Public/Admin/uploadify/uploadify.php",
                                //回调成功
                                'onUploadSuccess' : function(file, data, response) {
                                    //php返回图片路径
                                    $('input[name=art_thumb]').val(data);
                                    //设置图片的路径
                                    $('#art_thumb_img').attr('src',''+data).removeAttr('style');
//                                    alert(data);
                                }
                            });
                        });
                    </script>
                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>
                    <img src="<?php echo ($list["art_thumb"]); ?>" id="art_thumb_img" width="50px">
                </td>
                <br>

            </tr>


            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="art_description"><?php echo ($list["art_description"]); ?></textarea>
                </td>
            </tr>
            <tr>
                <th>文章内容：</th>
                <td>
                    <script src="/Public/Admin/ueditor/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ueditor/ueditor.all.min.js"> </script>
                    <script type="text/javascript" charset="utf-8" src="/Public/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
                    <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;"><?php echo (stripslashes(htmlspecialchars_decode($list["art_content"]))); ?></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height:22px;}
                    </style>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="button" onclick="art_edit()" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

</body>
</html>
<script>
    function art_edit(){

        var url='/index.php/Admin/Article/artEditAction';
        var data = $('#form1').serializeArray();
        $.post(url,data,function (data) {
            if(data.status !=0){
                dialog.error(data.message);
                return ;
            }
            dialog.success(data.message,'/index.php/Admin/Article/artList');
        },'JSON');
    }
</script>