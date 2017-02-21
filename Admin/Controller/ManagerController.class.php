<?php
    //命名空间
    namespace Admin\Controller;
    use Think\Controller;
    
    class ManagerController extends Controller{
        //管理员登录
        function login(){
            $this->display();
        }
        
        public function checkLogin()
        {
            $Admin = M('Manager');
            $arr['manager_name'] = I('post.username');
            $arr['manager_pwd'] = md5(I('post.password'));

            $manager = $Admin->where($arr)->find();
            $Verify = new \Think\Verify();

            $verifyCode = $Verify->check(I('post.checkCode'));

            if ($manager && $verifyCode) {

                    $_SESSION['manager_id'] = $manager['manager_id'];
                    $_SESSION['manager_name'] = $manager['manager_name'];
                    $_SESSION['manager_login'] = 1;

                    header('location:'.U('Admin/Index/index'));
                    return;
            } elseif (!$verifyCode){
                    $this->error('验证码失败','login',3);
            } else {
                    $this->error('密码错误','login',3);
            }
        }
        /**
         * [verify description]登录验证码
         * @return [type] [description]
         */
        public function verify(){
            $Verify = new \Think\Verify(
                 array(
                    'fontSize'    =>    18,    // 验证码字体大小
                    'length'      =>    4,     // 验证码位数
                    'useNoise'    =>    false, // 关闭验证码杂点
                    'height' => 20,
                )
            );
            $Verify->entry();
        }

        /**
            ajax 验证用户名
        **/
        public function ajaxCheckName()
        {
            if (IS_AJAX)
            {
                $Admin = M('manager');

                $count = $Admin->where($_POST)->count();

                if ($count) {
                        $this->ajaxReturn(1);
                } else{
                        $this->ajaxReturn(0);
                }
            }
        }

        function logout(){
            //清除session，同时跳转登陆页面
            session(null);
            $this->redirect('login');
        }
        
        function showlist(){
            $info = D('Manager')->where('flag=1')->select();
            $this->assign('info',$info);
            $this->display();
        }
        function tianjia() {
            $manager = D('manager');
            if($_POST)
            {
                $_POST['manager_pwd'] = md5($_POST['manager_pwd']);
                $z = $manager->add($_POST);
                if($z !== false)
                {
                    $this->redirect('showlist', array(), 1, '添加成功');
                }
                else
                {
                    $this->redirect('showlist', array(), 1, '添加成功');
                }
            }
            $this->display();
        }
        function xiugai($manager_id=0) {
            $manager = D('manager');
            if($_POST)
            {
                if($_POST['manager_pwd'])
                {
                    $z = $manager->save($_POST);
                }
                else
                {
                    $this->redirect('showlist');
                }
                if($z !== false)
                {
                    $this->redirect('showlist', array(), 1, '修改成功');
                }
                else{
                    $this->redirect('showlist', array('id'=>$manager_id), 1, '修改失败');
                }
            }
            $info = $manager->where('manager_id='.$manager_id)->find();
            $this->assign('info', $info);
            $this->display();
        }
        public function del($manager_id=0) {
            $manager = D('manager');
            if($manager_id)
            {
                $sql = "update manager set flag=0 where manager_id=".$manager_id;
                $z = $manager->execute($sql);
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

