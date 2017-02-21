<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改文章</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo ADMIN_CSS_URL; ?>/mine.css" type="text/css" rel="stylesheet"/>
        <!-- 配置文件 -->
        <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript" src="/ueditor/themes/default/css/ueditor.css"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container_article');
        </script>
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：文章管理-》修改文章</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="__CONTROLLER__/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form  action="__SELF__/xiugai" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td><input type="hidden" name="article_id" value="{$info.article_id}" /></td>
                </tr>
                <tr>
                    <td width='5%'>文章标题</td>
                    <td><input type="text" name="article_title" value="{$info.article_title}" /></td>
                </tr>
                <tr>
                    <td>文章作者</td>
                    <td>
                        <input type="text" name="author" value="{$info.author}" />
                    </td>
                </tr>
                <tr>
                    <td>文章摘要</td>
                    <td>
                        <textarea name="abstract" cols="80" rows="3">{$info.abstract}
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>文章内容</td>
                    <td>
                        <script id="container_article" name="article_content" type="text/plain">{$info.article_content}
                        </script>  
                    </td>
                </tr>
                <input type="hidden" value="1" id="type"/>
                <tr>
                    <td>所属群组</td>
                    <td>
                        <select name="group_id" id="group_id">
                            <option>请选择群组</option>
                            <foreach name="info_group" item="v">
                                <option value="{$v.group_id}"
                                    <if condition="$v.group_id eq $info['group_id']">selected</if>
                                >{$v.group_name}</option>
                            </foreach>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>所属标签</td>
                    <td id="tab_add">
                        <foreach name="info_tab" item="v">
                        <input type="checkbox" name="tab_ids[]" value="{$v.tab_id}"
                               <in name="v.tab_id" value="$info['tab_ids']">checked</in>
                        />{$v.tab_name}
                        </foreach>
                    </td>
                </tr>
                <input type="hidden" name="update_time" value="<?php echo time();?>" />
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
        <script src="<?php echo ADMIN_JS_URL; ?>/jquery-1.7.2.min.js"></script>
        <script src="<?php echo ADMIN_JS_URL; ?>/scripts.js"></script>
    </body>
</html>