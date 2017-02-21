<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>回收站列表</title>
        <link href="<?php echo ADMIN_CSS_URL; ?>/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：回收站管理-》群组回收站</span>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>群组名称</td>
                        <td align="center">操作</td>
                    </tr>
                    <foreach name="info" item="val">
                    <tr id="product1">
                        <td>{$val.group_id}</td>
                        <td>{$val.group_name}</td>
                        <td><a href="__SELF__/group_id/{$val.group_id}">启用</a></td>
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