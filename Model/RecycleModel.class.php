<?php

namespace Model;
use Think\Model;

class RecycleModel extends Model{
    public function getArticle($article_id=0) {
        $article = D('article');
        if($article_id)
        {
            $z = $article->where('article_id='.$article_id)->setField('flag', 1);
            if($z !== false && $z !==0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            $count = $article->where('flag=0')->count();
            $page_obj = $this->getPage($count, 10);
            $sql = "select article_id, article_title from article where flag=0 ".$page_obj->limit;
            $info = $article->query($sql);
            $pagelist = $page_obj->show();
            $result[0]=$info;//符合info条件的文章
            $result[1]=$pagelist;//分页信息
            return $result;
        }
    }
    public function getSentence($sentence_id=0) {
        $sentence = D('sentence');
        if($sentence_id)
        {
            $z = $sentence->where('sentence_id='.$sentence_id)->setField('flag', 1);
            if($z !== false && $z !==0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            $count = $sentence->where('flag=0')->count();
            $page_obj = $this->getPage($count, 10);
            $sql = "select sentence_id, sentence_content from sentence where flag=0 ".$page_obj->limit;
            $info = $sentence->query($sql);
            $pagelist = $page_obj->show();
            $result[0]=$info;//符合info条件的文章
            $result[1]=$pagelist;//分页信息
            return $result;
        }
    }
    public function getGroup($group_id=0) {
        $group = D('groups');
        if($group_id)
        {
            $z = $group->where('group_id='.$group_id)->setField('flag', 1);
            if($z !== false && $z !==0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            $count = $group->where('flag=0')->count();
            $page_obj = $this->getPage($count, 10);
            $sql = "select group_id, group_name from groups where flag=0 ".$page_obj->limit;
            $info = $group->query($sql);
            $pagelist = $page_obj->show();
            $result[0]=$info;//符合info条件的文章
            $result[1]=$pagelist;//分页信息
            return $result;
        }
    }
    public function getTab($tab_id=0) {
        $tab = D('tab');
        if($tab_id)
        {
            $z = $tab->where('tab_id='.$tab_id)->setField('flag', 1);
            if($z !== false && $z !==0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            $count = $tab->where('flag=0')->count();
            $page_obj = $this->getPage($count, 10);
            $sql = "select tab_id, tab_name from tab where flag=0 ".$page_obj->limit;
            $info = $tab->query($sql);
            $pagelist = $page_obj->show();
            $result[0]=$info;//符合info条件的文章
            $result[1]=$pagelist;//分页信息
            return $result;
        }
    }
    public function getManager($manager_id=0) {
        $manager = D('manager');
        if($manager_id)
        {
            $z = $manager->where('manager_id='.$manager_id)->setField('flag', 1);
            if($z !== false && $z !==0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            $count = $manager->where('flag=0')->count();
            $page_obj = $this->getPage($count, 10);
            $sql = "select manager_id, manager_name from manager where flag=0 ".$page_obj->limit;
            $info = $manager->query($sql);
            $pagelist = $page_obj->show();
            $result[0]=$info;//符合info条件的文章
            $result[1]=$pagelist;//分页信息
            return $result;
        }
    }
    public function getPage($count,$pageSize) {
        $page=new \Think\Page($count,$pageSize);
        $page->setConfig('header','共<b>%TOTAL_ROW%</b>条记录 | 每页<b>%LIST_ROW%</b>条 | 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页 | ');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','末页');
        $page->setConfig('first','首页');
        $page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %JUMP_PAGE%');
        return $page;
    }
}