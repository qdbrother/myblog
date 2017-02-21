<!DOCTYPE html>
<html>
    <head>
        <title>修改管理员</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo ADMIN_CSS_URL; ?>/mine.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：管理员管理-》修改管理员信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="__CONTROLLER__/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form action="__SELF__/xiugai" method="post">
                <input type="hidden" name="manager_id" value="{$info.manager_id}" />
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>管理员名称</td>
                    <td><input type="text" name="manager_name" value="{$info.manager_name}" autocomplete="off"/></td>
                </tr>
                <tr>
                    <td>管理员密码</td>
                    <td><input type="password" name="manager_pwd" value="" readonly onfocus="this.removeAttribute('readonly');" autocomplete="off"/></td>
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