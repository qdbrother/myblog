<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="<?php echo ADMIN_CSS_URL; ?>/admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <table cellspacing=0 cellpadding=0 width="100%" background="<?php echo ADMIN_IMG_URL; ?>/header_bg.jpg" border=0>
            <tr height="56px">
                <td width="260px">
                    <img height="56px" src="<?php echo ADMIN_IMG_URL; ?>/header_left.jpg" width="260px"/>
                </td>
                <td style="font-weight: bold; color: #fff; padding-top: 20px" align="center">
                    当前用户：<?php echo session('manager_name'); ?> &nbsp;&nbsp; 
                    <a style="color: #fff;" onclick="if (confirm('确定要退出吗？')) return true; else return false;" 
                        href="__MODULE__/Manager/logout" target=_top>退出系统</a> 
                        <!--target=_top 可以控制  网页头部  左部  右部都退出-->
                </td>
                <td align="right" width="268px">
                    <img height="56px" src="<?php echo ADMIN_IMG_URL; ?>/header_right.jpg" width="268px"/>
                </td>
            </tr>
        </table>
    </body>
</html>