<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加句子</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo ADMIN_CSS_URL; ?>/mine.css" type="text/css" rel="stylesheet"/>
         <style type="text/css">
        #edit {
            width: 1000px;
            border: 1px solid #ddd;
        }
        </style>
        <!-- 配置文件 -->
        <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript" src="/ueditor/themes/default/css/ueditor.css"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue_sentence = UE.getEditor('container_sentence');
        </script>
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：句子管理-》添加句子</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="__CONTROLLER__/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form action="__SELF__/tianjia" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>句子作者</td>
                    <td><input type="text" name="author" value="烽火戏诸侯"/></td>
                </tr>
                <tr>
                    <td>句子内容</td>
                    <td height="400px">
                        <script id="container_sentence" name="sentence_content" type="text/plain">
                        </script>
                    </td>
                </tr>
                <input type="hidden" value="2" id="type"/>
                <tr>
                    <td>所属群组</td>
                    <td>
                        <select name="group_id" id="group_id">
                            <option>请选择群组</option>
                            <foreach name='info_group' item='v'>
                            <option value="{$v.group_id}">{$v.group_name}</option>
                            </foreach>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>所属标签</td>
                    <td id="tab_add">
                        <foreach name='info_tab' item='v'>
                        <input type="checkbox" name="tab_id" value="{$v.tab_id}"/>{$v.tab_name}
                        </foreach>
                    </td>
                </tr>
                <input type="hidden" name="create_time" value="<?php echo time();?>"/>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
        <script src="<?php echo ADMIN_JS_URL; ?>/jquery-1.7.2.min.js"></script>
        <script src="<?php echo ADMIN_JS_URL; ?>/scripts.js"></script>
    </body>
</html>