<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="<?php echo ADMIN_CSS_URL; ?>/admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <table>
            <tr height=100>
                <td align=middle width=100>
                    <img height=100 src="<?php echo ADMIN_IMG_URL; ?>/admin_p.gif" width=90/>
                </td>
                <td>
                    <table height=100 cellspacing=0 cellpadding=0 width="100%" border=0>
                        <tr>
                            <td>当前时间：<?php echo date("Y-m-d H:i:s");?></td></tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 16px"><?php echo session('admin_name');?></td></tr>
                        <tr>
                            <td>欢迎进入网站管理中心！</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>