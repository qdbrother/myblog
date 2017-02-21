<?php
    header("content-type:text/html;charset = utf-8");

    //框架的两种模式：[默认]生产(线上)、开发(调试)
//    define('APP_DEBUG', true);//开发
    define('APP_DEBUG', false);//生产
    
    //Home分组
    define('CSS_URL','/Home/Public/css');
    define('IMG_URL','/Home/Public/images');
    define('JS_URL','/Home/Public/js');
    define('PLAY_URL','/Home/Public/play_source');
    define('MYBLOG_URL','http://www.qdaobrother.cn/');
    
    //Admin分组
    define('ADMIN_CSS_URL','/Admin/Public/css');
    define('ADMIN_JS_URL','/Admin/Public/js');
    define('ADMIN_IMG_URL','/Admin/Public/img');
    //引入入库文件
    include "./ThinkPHP/ThinkPHP.php";
?>
