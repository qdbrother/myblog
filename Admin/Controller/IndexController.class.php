<?php
    namespace Admin\Controller;
    use Think\Controller;
    class IndexController extends Controller{
        function head(){
            $this->display();
        }
        function left(){
            $admin_name = session('manager_name');
            if($admin_name==="admin"){
                $auth_infoA = D('Auth')->where("auth_level=0")->select();
                $auth_infoB = D('Auth')->where("auth_level=1")->select();
            }
            $this->assign("auth_infoA",$auth_infoA);
            $this->assign("auth_infoB",$auth_infoB);
            $this->display();
        }
        function right(){
            $this->display();
        }
        function index(){
            $this->display();
        }
    }
