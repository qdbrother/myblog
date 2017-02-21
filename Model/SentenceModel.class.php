<?php

namespace Model;
use Think\Model;

class SentenceModel extends Model{
    public function jz_info($tab_id=0) {
        if($tab_id)
        {
            $count = $this->where('tab_id='.$tab_id)->field('sentence_id')->count();
            $page_obj = $this->getPage($count, 10);
            $sql = 'select sentence_id, author, sentence_content, group_id, tab_id, create_time from sentence where tab_id='.$tab_id.' && flag=1 order by sentence_id desc '.$page_obj->limit;
        }
        else
        {
            $count = $this->field('sentence_id')->count();
            $page_obj = $this->getPage($count, 10);
            $sql = 'select sentence_id, author, sentence_content, group_id, tab_id, create_time from sentence where flag=1 order by sentence_id desc '.$page_obj->limit;
        }
        $info = $this->query($sql);
        file_put_contents('E:/flag.txt', $this->getLastSql());
        $pagelist = $page_obj->show();
        $result[0]=$info;//符合info条件的文章
        $result[1]=$pagelist;//分页信息
        return $result;
    }
    //分页
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

