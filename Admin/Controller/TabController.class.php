<?php 
    namespace Admin\Controller;
    use Think\Controller;
    class TabController extends Controller{
        function showlist(){
            $tab = D('Tab');
            if(!empty($_POST))
            {
                $str = $_POST['tab_name'];
                $tab->where("tab_name like '%{$str}%'");
                $info = $tab->where('flag=1')->select();
            }
            else{
            //①获得总记录数据
            $total=$tab->count();
            //②实例化分页类对象
            $page_obj = new \Tools\Page($total);
            //③自定义sql语句，获取每页信息
            $sql = "select * from tab where flag=1 order by tab_id desc ".$page_obj->limit;
            $info = $tab->query($sql);
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
            $tab = D('Tab');
            $group = D('Groups');
            if(!empty($_POST)){
                $z = $tab->add($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'添加标签成功');
                }
                else{
                    $this->redirect('tianjia',array(),1,'请重新添加');
                }
            }
            
            $this->display();
        }
        //修改
        function xiugai($tab_id){
            $tab = D('Tab');
            $group = D('Groups');
            if(!empty($_POST)){
                $z = $tab->save($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'修改标签成功');
                }
                else
                {
                    $this->redirect('xiugai',array('tab_id'=>$tab_id),1,'修改标签失败');
                }
            }
            else{
                $group_info = $group->select();
                $this->assign('group_info',$group_info);
                $info = $tab->find($tab_id);
                $this->assign('info',$info);
            }
            $this->display();
        }
        public function tab(){
            $tab = D('tab');
            if($_POST['val'])
            {
                $where['group_id'] = $_POST['val'];
                $where['type'] = $_POST['type'];
                $tab_info = $tab->field('tab_id,tab_name')->where($where)->select();
                $sql = $tab->getLastSql();
                $data = json_encode($tab_info);
                echo $data;
                exit;
            }
        }
        public function del($tab_id=0) {
            $tab = D('tab');
            if($tab_id)
            {
                $sql = "update tab set flag=0 where tab_id=".$tab_id;
                $z = $tab->execute($sql);
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