var cate = {

    cateDel:function (id) {
        layer.open({
            content : "你确定要删除吗？",
            icon:3,
            btn : ['是','否'],
            yes : function(){
                var url='/Admin/Category/cateDel';
                var data = {'id':id};

                $.post(url,data,function (data) {
                    if(data.status !=0){
                        dialog.error(data.message);
                        return ;
                    }
                    dialog.success(data.message,'/index.php/Admin/Category/cateList');

                },'JSON');
            },
        });
    },
    
    changeOrder:function (obj,cate_id) {

        var order = $(obj).val();

        var url='/Admin/Category/changeOrder';
        var data = {'order': order, 'cate_id': cate_id};
        $.post(url,data,function (data) {
            if(data.status !=0){
                layer.msg(data.message);
                return ;
            }
            layer.msg(data.message);

        },'JSON');
    }
};