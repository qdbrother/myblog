<?php 
    namespace Admin\Controller;
    use Think\Controller;
    class GroupsController extends Controller{
        function showlist(){
            //实现数据分页效果
            $group = D('Groups');
            if(!empty($_POST))
            {
                $str = $_POST['group_name'];
                $group->where("group_name like '%{$str}%'");
                $info = $group->where('flag=1')->select();
            }
            else{
            //数据操作常用方法
            //①获得总记录数据
            $total=$group->count();
            //②实例化分页类对象
            $page_obj = new \Tools\Page($total);
            //③自定义sql语句，获取每页信息
            $sql = "select * from groups where flag=1 order by group_id desc ".$page_obj->limit;
            $info = $group->query($sql);
            //④获取页码列表
            //fpage封装了分页列表超链接，并通过array数组作为参数，进行控制，如果不想要多余的信息，可以通过传递参数进行控制
            $pagelist = $page_obj->fpage(array(0,2,3,4,5,6,7,8));
            $this->assign('pagelist',$pagelist);
            }
            $this->assign('info',$info);
            $this->display();
        }
        //添加
        function tianjia(){
            $group = D('Groups');
            if(!empty($_POST)){
                $z = $group->add($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'添加群组成功');
                }
            }
            else{
                $this->display();
            }
        }
        //修改
        function xiugai($group_id){
            $group = D('Groups');
            if(!empty($_POST)){
                $z = $group->save($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'修改群组成功');
                }
                else
                {
                    $this->redirect('xiugai',array('group_id'=>$group_id),1,'修改群组失败');
                }
            }
            else{
                $info = $group->find($group_id);
                $this->assign('info',$info);
            }
            $this->display();
        }
        public function del($group_id=0) {
            $group = D('group');
            if($group_id)
            {
                $sql = "update groups set flag=0 where group_id=".$group_id;
                $z = $group->execute($sql);
                if($z !== false && $z !== 0)
                {
                    $this->redirect('showlist', array(), 1, '删除成功，请到回收站中查看');
                }
                else
                {
                    $this->redirect('showlist', array(), 1, '删除失败');
                }
            }
        }
    }