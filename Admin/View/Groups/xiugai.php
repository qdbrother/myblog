<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改群组</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo ADMIN_CSS_URL; ?>/mine.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：群组管理-》修改群组信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="__CONTROLLER__/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form action="__SELF__/xiugai" method="post">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td><input type="hidden" name="group_id" value="{$info.group_id}" /></td>
                </tr>
                <tr>
                    <td>群组名称</td>
                    <td><input type="text" name="group_name" value="{$info.group_name}" /></td>
                </tr>
                <tr>
                    <td>群组类型</td>
                    <td>
                        <select name="type">
                            <option>请选择类型</option>
                            <option value="1" <if condition="$info.type eq 1">selected</if>>文章类型</option>
                            <option value="2" <if condition="$info.type eq 2">selected</if>>句子类型</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>排序</td>
                    <td><input type="text" name="group_sort" value="{$info.group_sort}" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html>