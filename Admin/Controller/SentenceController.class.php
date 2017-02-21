<?php 
    namespace Admin\Controller;
    use Think\Controller;
    class SentenceController extends Controller{
        function showlist(){
            $group = D('Groups');
            $info_group = $group->where('type=2 && flag=1')->select();
            $tab = D('Tab');
            $info_tab = $tab->where('type=2 && flag=1')->select();
            //实现数据分页效果
            $sentence = D('Sentence');
            if(!empty($_POST))
            {
                $str = $_POST['content'];
                if($str)
                {
                    $sentence->where("sentence_content like '%{$str}%'");
                    $info = $sentence->where('flag=1')->select();
                }
                else{
                    $this->redirect("showlist");
                }                
            }
            else{
                //①获得总记录数据
                $total=$sentence->count();
                //②实例化分页类对象
                $page_obj = new \Tools\Page($total);
                $sql = "select * from sentence where flag=1 order by sentence_id desc ".$page_obj->limit;
                $info = $sentence->query($sql);
                //④获取页码列表
                //fpage封装了分页列表超链接，并通过array数组作为参数，进行控制，如果不想要多余的信息，可以通过传递参数进行控制
                $pagelist = $page_obj->fpage(array(0,2,3,4,5,6,7,8));
                $this->assign('pagelist',$pagelist);
            }
            $this->assign('info_group',$info_group);
            $this->assign('info_tab',$info_tab);
            $this->assign('info',$info);
            $this->display();
        }
        //添加
        function tianjia(){
            $group = D('Groups');
            $info_group = $group->where('type=2 && flag=1')->select();
            $sentence = D('Sentence');
            $tab = D('Tab');
            $info_tab = $tab->where('type=2 && flag=1')->select();
            if(!empty($_POST)){
                $z = $sentence->add($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'添加笔记成功');
                }
                else{
                    $this->redirect('tiajia',array(),1,'请重新添加');
                }
            }
			$this->assign('info_group', $info_group);
            $this->assign('info_tab', $info_tab);
            $this->display();
        }
        //修改
        function xiugai($sentence_id){
            $sentence = D('Sentence');
            $group = D('Groups');
            $info_group = $group->where('type=2 && flag=1')->select();
            $tab = D('Tab');
            $info_tab = $tab->where('type=2 && flag=1')->select();
            if(!empty($_POST)){
                $z = $sentence->save($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'修改笔记成功');
                }
                else
                {
                    $this->redirect('xiugai',array('sentence_id'=>$sentence_id),1,'修改笔记失败');
                }
            }
            else{
                $info = $sentence->find($sentence_id);
                $this->assign('info_group',$info_group);
                $this->assign('info_tab',$info_tab);
                $this->assign('info',$info);
            }
            $this->display();
        }
        public function tab(){
            $tab = D('tab');
            if($_POST['val'])
            {
                $tab_info = $tab->field('tab_id,tab_name')->where('group_id='.$_POST['val'] && 'type=2 && flag=1')->select();
                $data = json_encode($tab_info);
                echo $data;
                exit;
            }
        }
        public function del($sentence_id=0) {
            $sentence = D('sentence');
            if($sentence_id)
            {
                $sql = "update sentence set flag=0 where sentence_id=".$sentence_id;
                $z = $sentence->execute($sql);
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