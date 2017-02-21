<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $article = new \Model\ArticleModel();
        $result = $article->proc_article(0, 0, 0);//获取文章目录和分页信息
        $menu_info = $article->menu_info();//获取顶部菜单
        $tab_info = $article->tab_info(0, 0);//获取标签信息
        $top_new_info = $article->top_new_info();
        $this->assign('info',$result[0]);
        $this->assign('pagelist',$result[1]);
        $this->assign('menu_tab',$menu_info['tab']);
        $this->assign('menu_group',$menu_info['group']);
        $this->assign('info_tab_article',$tab_info['article']);
        $this->assign('info_tab_sentence',$tab_info['sentence']);
        $this->assign('new_article',$top_new_info['new_article']);
        $this->assign('top_article',$top_new_info['top_article']);//热评文章
        $this->display();
    }
    
    public function search($group_id=0, $tab_id=0, $word=''){
        $article = new \Model\ArticleModel();
        $result = $article->proc_article($group_id, $tab_id, $word);//获取文章目录和分页信息
        $menu_info = $article->menu_info();//获取顶部菜单
        $tab_info = $article->tab_info($group_id, $tab_id);//获取标签信息
        $top_new_info = $article->top_new_info();
        $this->assign('info',$result[0]);
        $this->assign('pagelist',$result[1]);
        $this->assign('menu_tab',$menu_info['tab']);
        $this->assign('menu_group',$menu_info['group']);
        $this->assign('info_tab_article',$tab_info['article']);
        $this->assign('info_tab_sentence',$tab_info['sentence']);
        $this->assign('tab_info',$tab_info);
        $this->assign('new_article',$top_new_info['new_article']);
        $this->assign('top_article',$top_new_info['top_article']);//热评文章
        $this->display();
    }
    
    public function detail($article_id=0) {
        $article = new \Model\ArticleModel();
        $menu_info = $article->menu_info();//获取顶部菜单
        $tab_info = $article->tab_info(0, 0);//获取标签信息
        $top_new_info = $article->top_new_info();
        if($article_id)
        {
            $info = $article->find($article_id);
        }
        $this->assign('info',$info);
        $this->assign('menu_tab',$menu_info['tab']);
        $this->assign('menu_group',$menu_info['group']);
        $this->assign('info_tab_article',$tab_info['article']);
        $this->assign('info_tab_sentence',$tab_info['sentence']);
        $this->assign('new_article',$top_new_info['new_article']);
        $this->assign('top_article',$top_new_info['top_article']);//热评文章
        $this->display();
    }
    
    public function chat() {
        $article = new \Model\ArticleModel();
        $menu_info = $article->menu_info();//获取顶部菜单
        $tab_info = $article->tab_info(0, 0);//获取标签信息
        $top_new_info = $article->top_new_info();
        $this->assign('menu_tab',$menu_info['tab']);
        $this->assign('menu_group',$menu_info['group']);
        $this->assign('info_tab_article',$tab_info['article']);
        $this->assign('info_tab_sentence',$tab_info['sentence']);
        $this->assign('new_article',$top_new_info['new_article']);
        $this->assign('top_article',$top_new_info['top_article']);//热评文章
        $this->display();
    }
    public function juzi($tab_id=0){
        $sentence = new \Model\SentenceModel();
        $article = new \Model\ArticleModel();
        $menu_info = $article->menu_info();//获取顶部菜单
        $tab_info = $article->tab_info(0, $tab_id);//获取标签信息
        $top_new_info = $article->top_new_info();
        $result = $sentence->jz_info($tab_id);
        $this->assign('pagelist',$result[1]);
        $this->assign('info',$result[0]);
        $this->assign('menu_tab',$menu_info['tab']);
        $this->assign('menu_group',$menu_info['group']);
        $this->assign('info_tab_article',$tab_info['article']);
        $this->assign('info_tab_sentence',$tab_info['sentence']);
        $this->assign('tab_info',$tab_info);
        $this->assign('new_article',$top_new_info['new_article']);
        $this->assign('top_article',$top_new_info['top_article']);//热评文章
        $this->display();
    }
    public function ip(){
        $ip = $_POST['ip'];
        if($_POST['article_id'])
        {
            $article_id = $_POST['article_id'];
            $article = D("Article");
            $ips = new \Model\ArtipModel();
            $res = $ips->ips($ip, $article_id);
            $row = $article->where('article_id='.$article_id)->find();
            if($res)
            {
                $row['pv'] = $row['pv']+1;
                $article->save($row);
            }
            echo $row['pv'];
        }
    }
    public function get_tabs() {
        $id = $_POST['id'];
        if($id === '1')
        {
            $group = D('groups');
            $info = $group->field('group_id,group_name')->select();
            $data = json_encode($info);
            echo $data;
            exit();
        }
        elseif($id === '2')
        {
            $tab = D('tab');
            $info = $tab->field('tab_id,tab_name')->select();
            $data = json_encode($info);
            echo $data;
            exit();
        }
        else
        {
            exit();
        }
    }
}