<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="/Application/Common/JS/jquery.js"></script>
    <link rel="stylesheet" href="/Public/Admin/style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/Public/Admin/style/font/css/font-awesome.min.css">
    <script type="text/javascript" src="/Public/Admin/style/js/ch-ui.admin.js"></script>
    <script src="/Application/Common/JS/layer.js"></script>
    <script src="/Public/Admin/style/js/dialog.js"></script>
    <script src="/Public/Admin/style/js/cate.js"></script>


</head>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="" method="post">
        <table class="search_tab">
            <tr>
                <th width="120">选择分类:</th>
                <td>
                    <select onchange="javascript:location.href=this.value;">
                        <option value="">全部</option>
                        <option value="http://www.baidu.com">百度</option>
                        <option value="http://www.sina.com">新浪</option>
                    </select>
                </td>
                <th width="70">关键字:</th>
                <td><input type="text" name="keywords" placeholder="关键字"></td>
                <td><input type="submit" name="sub" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form method="post" id="form1">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="/Admin/Category/cateList"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%"><input type="checkbox" name=""></th>
                    <th class="tc">排序</th>
                    <th class="tc">ID</th>
                    <th>分类名称</th>
                    <th>分类标题</th>
                    <th>点击</th>
                    <th>操作</th>
                </tr>


                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                    <td class="tc">
                        <input type="text" name="ord[]" value="<?php echo ($vo["cate_order"]); ?>" onchange="cate.changeOrder(this,'<?php echo ($vo["cate_id"]); ?>')">
                    </td>
                    <td class="tc"><?php echo ($vo["cate_id"]); ?></td>
                    <td>
                        <a href="#"><?php echo ($vo["_cate_name"]); ?></a>
                    </td>
                    <td><?php echo ($vo["cate_title"]); ?></td>
                    <td><?php echo ($vo["cate_view"]); ?></td>

                    <td>
                        <a href="/index.php/Admin/Category/cateEdit?cate_id=<?php echo ($vo["cate_id"]); ?>">修改</a>
                        <a href="javascript:;" onclick="cate.cateDel('<?php echo ($vo["cate_id"]); ?>')">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>


            </table>

            <!-- 页码 -->
            <div class="page_nav">
                <?php echo ($page); ?>
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->



</body>
</html>