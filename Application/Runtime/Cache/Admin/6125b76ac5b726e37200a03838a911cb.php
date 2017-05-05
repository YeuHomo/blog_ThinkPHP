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

<div class="result_wrap">
    <form action="" method="post">
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>分类编号：</th>
                <td>
                    <input type="text"  name="cate_id" value="<?php echo ($list["cate_id"]); ?>" readonly>
                </td>
            </tr>
            <tr>
                <th width="120"><i class="require">*</i>父级分类：</th>
                <td>
                    <select name="p_id">
                        <option value="">==请选择==</option>
                        <?php if(is_array($p_list)): $i = 0; $__LIST__ = $p_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i; if($list['cate_pid'] == $p['cate_id']): ?><option value="<?php echo ($p["cate_id"]); ?>" selected><?php echo ($p["cate_name"]); ?></option>
                             <?php else: ?>
                                <option value="<?php echo ($p["cate_id"]); ?>"><?php echo ($p["cate_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>分类名称：</th>
                <td>
                    <input type="text"  name="cate_name" value="<?php echo ($list["cate_name"]); ?>">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>分类标题：</th>
                <td>
                    <input type="text" class="lg" name="cate_title" value="<?php echo ($list["cate_title"]); ?>">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="button" onclick="cate_edit()" value="提交">
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
function cate_edit(){
    var p_id = $('select[name=p_id]').val();
    var cate_name = $('input[name=cate_name]').val();
    var cate_title = $('input[name=cate_title]').val();
    var cate_id = $('input[name=cate_id]').val();

    var url='/Admin/Category/cateEditAction';
    var data = {'p_id':p_id,'cate_name':cate_name,'cate_title':cate_title,'cate_id':cate_id};

    $.post(url,data,function (data) {
        if(data.status !=1){
        dialog.error(data.message);
        return ;
    }
        dialog.success(data.message,'/index.php/Admin/Category/cateList');
        },'JSON');
    }
</script>