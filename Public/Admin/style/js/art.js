var art = {

    artDel: function (id) {
        layer.open({
            content: "你确定要删除吗？",
            icon: 3,
            btn: ['是', '否'],
            yes: function () {
                var url = '/Admin/Article/artDel';
                var data = {'id': id};
                $.post(url, data, function (data) {
                    if (data.status != 0) {
                        dialog.error(data.message);
                        return;
                    }
                    dialog.success(data.message, '/index.php/Admin/Article/artList');

                }, 'JSON');
            },
        });
    },


    artAdd:function () {
        var cate_id = $('select[name=cate_id]').val();
        var title = $('input[name=art_title]').val();
        var editor = $('input[name=art_editor]').val();
        var thumb = $('input[name=art_thumb]').val();
        var description =$('#art_description').val();
        var content = ue.getContent();


        $.ajax({
            type:'POST',
            url :'/index.php/Admin/Article/artAddAction',
            dataType:'json',
            data:{cate_id:cate_id,title:title,editor:editor,description:description,thumb:thumb,content:content},
            success:function (data) {
                if(data.status !=0 ){
                    layer.msg(data.message,{icon:0,time: 2000});
                    return;
                }
                layer.msg(data.message, {
                    icon: 1,
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function() {
                    location.href = '/index.php/Admin/Article/artList';//成功跳转到页面
                });
            },
            error:function (xhr,status) {
                console.log(xhr);
                console.log(status);
            }

        });
    }
}