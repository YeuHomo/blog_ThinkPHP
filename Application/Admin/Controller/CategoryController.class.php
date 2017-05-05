<?php

namespace Admin\Controller;

use Think\Controller;


class CategoryController extends Controller{

    public function cateList(){

        $cate = M('category');

        $list = $cate->order('cate_order')->select();
        $data = $this->getTree($list);
        //实现分页

        $count = $cate->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $list1 = array_slice($data,$Page->firstRow,$Page->listRows);

        $this->assign('page',$show);
        $this->assign('list',$list1);
        $this->display();
    }


    public function getTree($data){
        //新的数组用于保存
        $arr = Array();
        //遍历数据库中的
        foreach ($data as $k=>$v){
            $v['_cate_name'] = $v['cate_name'];
            //如果父分类为0.则为父分类
            if($v['cate_pid'] == 0){
                $arr[] = $v;
                //子级的cate_pid==父类的cate_id
                foreach ($data as $n=>$m){
                    if($m['cate_pid'] == $v['cate_id']){
                        $m['_cate_name'] = '┣' . $m['cate_name'];
                        $arr[] =$m;
                    }
                }

            }
        }
        return $arr;
    }

    public function cateAdd(){

        $p_cate = M('category');
        $p_list = $p_cate->where('cate_pid=0')->select();

        $this->assign('p_list',$p_list);
        $this->display();
    }

    public function cateAddAction(){

        $p_id = I('post.p_id','');
        $name = I('post.cate_name','');
        $title = I('post.cate_title','');
        $order = I('post.cate_order');

        if(trim($name)==''){
            setJson(2,'请输入分类名称');
        }
        if(trim($title)==''){
            setJson(1,'请输入分类标题');
        }
        if(trim($order)=='' || !is_numeric($order)){
            setJson(3,'请输入正确的分类排序！必须为正整数！');
        }

        $User = M('category');
        $cate['cate_name']=$name;
        $cate['cate_title']=$title;
        $cate['cate_pid']=$p_id;
        $res = $User->data($cate)->add();
        if(!$res){
            setJson(4,'添加失败！请稍后重试！');
        }
        setJson(0,'添加成功！');

        $this->display();
    }

    public function cateDel(){

        $id = I('post.id');
        $del = M('category');
        $isDel = $del->find($id);
        if($isDel==null){
            setJson(1,'该分类不存在！');
        }

        $res = $del->where('cate_id='.$id)->delete();
        if(!$res){
            setJson(2,'删除失败，请稍后重试！');
        }
        setJson(0,'删除成功！');

        $this->display();
    }

    public function cateEdit(){

        $id=I('get.cate_id');

        $list = M('category')->where('cate_id='.$id)->find();
        $this->assign('list',$list);

        $p_list = M('category')->where('cate_pid=0')->select();
        $this->assign('p_list',$p_list);

        $this->display();
    }

    public function cateEditAction(){

        $p_id = I('post.p_id');
        $cate_name = I('post.cate_name');
        $cate_title = I('post.cate_title');
        $cate_id = I('post.cate_id');

        $cate = M('category');

        $data['cate_pid'] = $p_id;
        $data['cate_name'] = $cate_name;
        $date['cate_title'] = $cate_title;
        $res = $cate->where('cate_id='.$cate_id)->save($data);

        if(!$res){
            setJson(0,'修改失败！请重试！');
        }
        setJson(1,'修改成功！');

    }


    public function changeOrder(){

        $order = I('post.order');
        $cate_id = I('post.cate_id');

        if(!is_numeric($order)){
            setJson(2,'请输入正确的排序值！');
        }
        $cate = M('category');
        $data['cate_order']=$order;


        $res = $cate->where('cate_id='.$cate_id)->save($data);
        if(!$res){
            setJson(1,'排序失败！请重试！');
        }
        setJson(0,'排序成功！');
    }
}