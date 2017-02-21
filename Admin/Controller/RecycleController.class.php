<?php
    namespace Admin\Controller;
    use Think\Controller;
    class RecycleController extends Controller{
        public function article() {
            $article_id = I('article_id');
            $recycle = new \Model\RecycleModel();
            $result = $recycle->getArticle($article_id);
            if($article_id)
            {
                if($result)
                {
                    $this->redirect('Article/showlist', array(), 1, '启用成功');
                }
                else
                {
                    $this->redirect('article', array(), 1, '启用失败');
                }
            }
            else
            {
                $this->assign('info', $result[0]);
                $this->assign('pagelist', $result[1]);
                $this->display();
            }
        }
        public function sentence() {
            $sentence_id = I('sentence_id');
            $recycle = new \Model\RecycleModel();
            $result = $recycle->getSentence($sentence_id);
            if($sentence_id)
            {
                if($result)
                {
                    $this->redirect('Sentence/showlist', array(), 1, '启用成功');
                }
                else
                {
                    $this->redirect('sentence', array(), 1, '启用失败');
                }
            }
            else
            {
                $this->assign('info', $result[0]);
                $this->assign('pagelist', $result[1]);
                $this->display();
            }
        }
        public function group() {
            $group_id = I('group_id');
            $recycle = new \Model\RecycleModel();
            $result = $recycle->getGroup($group_id);
            if($group_id)
            {
                if($result)
                {
                    $this->redirect('Groups/showlist', array(), 1, '启用成功');
                }
                else
                {
                    $this->redirect('group', array(), 1, '启用失败');
                }
            }
            else
            {
                $this->assign('info', $result[0]);
                $this->assign('pagelist', $result[1]);
                $this->display();
            }
        }
        public function tab() {
            $tab_id = I('tab_id');
            $recycle = new \Model\RecycleModel();
            $result = $recycle->getTab($tab_id);
            if($tab_id)
            {
                if($result)
                {
                    $this->redirect('Tab/showlist', array(), 1, '启用成功');
                }
                else
                {
                    $this->redirect('tab', array(), 1, '启用失败');
                }
            }
            else
            {
                $this->assign('info', $result[0]);
                $this->assign('pagelist', $result[1]);
                $this->display();
            }
        }
        public function manager() {
            $manager_id = I('manager_id');
            $recycle = new \Model\RecycleModel();
            $result = $recycle->getManager($manager_id);
            if($manager_id)
            {
                if($result)
                {
                    $this->redirect('Manager/showlist', array(), 1, '启用成功');
                }
                else
                {
                    $this->redirect('manager', array(), 1, '启用失败');
                }
            }
            else
            {
                $this->assign('info', $result[0]);
                $this->assign('pagelist', $result[1]);
                $this->display();
            }
        }
    }
    