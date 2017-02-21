<?php

namespace Model;
use Think\Model;

class ManagerModel extends Model{
    
    public function checkNamePwd($name,$pwd){
        //根据$name判断名字是否存在
        $info = $this->where("mg_name='$name'")->find();
        //如果$name存在，再根据名字把响应的密码提取出来与$pwd比较
        if($info){
            if($info['mg_pwd']===$pwd){
                return $info;
            }
        }
        return null;
    }
}

