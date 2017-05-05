<?php

namespace Admin\Controller;

use Think\Controller;

class ArticleController extends Controller{

    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
        $upload->rootPath = './Public/';
        $upload->savePath = '/Uploads/'. $position;// 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        //print_r($info);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $this->success('上传成功！');
            foreach($info as $file){
                $bigimg = $file['savepath'].$file['savename'];
            }
        }
        $model = M('img');
        // 取得成功上传的文件信息
        $info = $upload->upload();
        // 保存当前数据对象
        $data['goods_img'] = $bigimg;
        $model->add($data);
    }

    public function uploadify()
    {
        if (!empty($_FILES)) {
            import("@.ORG.UploadFile");
            $upload = new \Org\UploadFile();
            $upload->maxSize = 2048000;
            $upload->allowExts = array('jpg','jpeg','gif','png');
            $upload->savePath = "./Public/images/";
            $upload->thumb = true; //设置缩略图
            $upload->imageClassPath = "@.ORG.Image";
            $upload->thumbPrefix = "130_,75_,24_"; //生成多张缩略图
            $upload->thumbMaxWidth = "130,75,24";
            $upload->thumbMaxHeight = "130,75,24";
            $upload->saveRule = uniqid; //上传规则
            $upload->thumbRemoveOrigin = true; //删除原图
            if(!$upload->upload()){
                $this->error($upload->getErrorMsg());//获取失败信息
            } else {
                $info = $upload->getUploadFileInfo();//获取成功信息
            }
            echo $info[0]['savename'];    //返回文件名给JS作回调用
        }
    }

    public function artList(){
        $art = M('article');

        $count = $art->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $artList = $art->order('art_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('page',$show);
        $this->assign('artList',$artList);
        $this->display();
    }

    public function artAdd(){

        $p_cate = M('category');
        $list = $p_cate->select();

        $a = A('Category');
        $p_list =$a->getTree($list);

        $this->assign('cate_list',$p_list);
        $this->display();
    }

    public function artAddAction(){

        $cate_id = I('post.cate_id','');
        $art_title = I('post.title','');
        $art_editor = I('post.editor','');
        $art_description = I('post.description','');
        $art_content = I('post.content','');
        $art_thumb = I('post.thumb');




        if(trim($art_title)==''){
            setJson(2,'请输入文章标题');
        }
        if(trim($art_editor)==''){
            setJson(1,'请输入文章作者');
        }
        if(trim($art_content)==''){
            setJson(3,'请输入文章内容');
        }

        $User = M('article');
        $art['art_title']=$art_title;
        $art['art_editor']=$art_editor;
        $art['art_description']=$art_description;
        $art['art_content']=$art_content;
        $art['cate_id']=$cate_id;
        $art['art_time'] = time();
        $art['art_thumb'] =$art_thumb;

//        $info = $upload->upload();
//        $art['art_thumb']=$info[0]['savename'];

        $res = $User->data($art)->add();
        if(!$res){
            setJson(4,'添加失败！请稍后重试！');
        }
        setJson(0,'添加成功！');

        $this->display();
    }

    public function artDel(){

        $id = I('post.id');
        $del = M('article');
        $isDel = $del->find($id);
        if($isDel==null){
            setJson(1,'该文章不存在！');
        }

        $res = $del->where('art_id='.$id)->delete();
        if(!$res){
            setJson(2,'删除失败，请稍后重试！');
        }
        setJson(0,'删除成功！');

        $this->display();
    }

    public function artEdit(){
        $art_id = I('get.art_id');

        $list = M('article')->where('art_id='.$art_id)->find();
        $this->assign('list',$list);

        $p_cate = M('category');
        $list = $p_cate->select();

        $a = A('Category');
        $p_list =$a->getTree($list);
        $this->assign('cate_list',$p_list);

        $this->display();
    }

    public function artEditAction(){
        $art_id =I('post.art_id');
//        $cate_id = I('post.cate_id');
//        $art_title = I('post.art_title');
//        $art_editor = I('post.art_editor');
//        $art_description = I('post.art_description');
//        $art_content = I('post.art_content');

//        if(trim($art_title)==''){
//            setJson(2,'请输入文章标题');
//        }
//        if(trim($art_editor)==''){
//            setJson(1,'请输入文章作者');
//        }
//        if(trim($art_content)==''){
//            setJson(3,'请输入文章内容');
//        }

        $art = M('article');

        $data = I('post.');
        $res = $art->where('art_id='.$art_id)->save($data);
        if(!$res){
            setJson(4,'修改失败！请重试！');
        }
        setJson(0,'修改成功！');
    }


}