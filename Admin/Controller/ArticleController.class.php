<?php 
    namespace Admin\Controller;
    use Think\Controller;
    class ArticleController extends Controller{
        function showlist(){
            $article = D('Article');
            if(!empty($_POST))
            {
                $str = $_POST['title'];
                $article->where("article_title like '%{$str}%'");
                $info = $article->where('flag=1')->select();
            }
            else{
            //①获得总记录数据
            $total=$article->count();
            //②实例化分页类对象
            $page_obj = new \Tools\Page($total);
            
            //③自定义sql语句，获取每页信息
            $sql = "select * from article where flag=1 order by article_id desc ".$page_obj->limit;
            $info = $article->query($sql);
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
            //一个添加函数实现两个逻辑：展示表单，收集信息
            $article = D('Article');
            $group = D('Groups');
            $info_group = $group->where('type=1 && flag=1')->select();
            $tab = D('Tab');
            $info_tab = $tab->where('type=1 && flag=1')->select();
            if(!empty($_POST)){
                //收集表单
                $_POST['tab_ids'] =  implode(',', $_POST['tab_ids']);
                preg_match_all('/<img[^>]*src\s?=\s?[\'|"]([^\'|"]*)[\'|"]/is', $_POST['article_content'], $picarr);
                $_POST['pic_url'] = $picarr[1][0];
                $z = $article->add($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'添加文章成功');
                }
            }
            else{
                //展示表单
                $this->assign('info_group',$info_group);
                $this->assign('info_tab',$info_tab);
                $this->display();
            }
        }
        //修改
        function xiugai($article_id){
            $article = D('Article');
            $group = D('Groups');
            $info_group = $group->where('type=1 && flag=1')->select();
            $tab = D('Tab');
            $info_tab = $tab->where('type=1 && flag=1')->select();
            if(!empty($_POST)){
                for($i=0;$i<count($_POST['tab_ids']);$i++)
                {
                    $tab_ids .= $_POST['tab_ids'][$i].',';
                }
                $_POST['tab_ids']=  rtrim($tab_ids,',');
                preg_match_all('/<img[^>]*src\s?=\s?[\'|"]([^\'|"]*)[\'|"]/is', $_POST['article_content'], $picarr);
                $_POST['pic_url'] = $picarr[1][0];
                $z = $article->save($_POST);
                if($z !== false && $z !==0){
                    $this->redirect('showlist',array(),1,'修改文章成功');
                }
                else
                {
                    $this->redirect('xiugai',array('article_id'=>$article_id),1,'修改文章失败');
                }
            }
            else{
                $info = $article->find($article_id);
                $this->assign('info_group',$info_group);
                $this->assign('info_tab',$info_tab);
                $this->assign('info',$info);
            }
            $this->display();
        }
        public function del($article_id=0) {
            $article = D('article');
            if($article_id)
            {
                $sql = "update article set flag=0 where article_id=".$article_id;
                $z = $article->execute($sql);
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