<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>群组列表</title>
        <link href="<?php echo ADMIN_CSS_URL; ?>/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：群组管理-》群组列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="__CONTROLLER__/tianjia">【添加群组】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="__CONTROLLER__/showlist" method="post">
                    <input type="text" name="group_name" placeholder="群组名称"/>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>群组名称</td>
                        <td>群组类型</td>
                        <td>排序</td>
                        <td align="center" colspan="2">操作</td>
                    </tr>
                    <foreach name='info' item='val'>
                    <tr id="product1">
                        <td>{$val.group_id}</td>
                        <td>{$val.group_name}</td>
                        <td><if condition="$val.type eq 1">文章类型<else />句子类型</if></td>
                        <td>{$val.group_sort}</td>
                        <td><a href="__CONTROLLER__/xiugai/group_id/{$val.group_id}">修改</a></td>
                        <td><a  onclick="javascript:if(confirm('删除？')) return true; else return false;" href="__CONTROLLER__/del/group_id/{$val.group_id}">删除</a></td>
                    </tr>
                    </foreach>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            {$pagelist}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>