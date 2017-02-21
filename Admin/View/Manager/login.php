<html>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>登录(Login)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_CSS_URL; ?>/style.css">
    <script src="<?php echo ADMIN_JS_URL; ?>/html5.js"></script>
    <style>
        body {
            color: #337AB7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row a"></div>
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <form action="{:U('Admin/Manager/checkLogin')}" method="post" class="form-horizontal" role="form">
                    <h1>后台登录</h1>
                    <div class="form-group has-feedback">
                        <label for="username" class="col-xs-2 control-label">用户名</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control input-lg" name="username" id="username" placeholder="请输入用户名" autofocus style="background: rgba(45,45,45,.15);">
                            <span class="form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="password" class="col-xs-2 control-label">密　码</label>
                        <div class="col-xs-8">
                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="请输入密码" style="background: rgba(45,45,45,.15);">
                            <span class="form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="checkCode" class="col-xs-2 control-label">验证码</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control input-lg" name="checkCode" id="checkCode" placeholder="验证码" style="background: rgba(45,45,45,.15);">
                            <span class="form-control-feedback"></span>
                        </div>
                        <div class="col-xs-5">
                            <img id="verifyCode" class="verifyCode" src="{:U('verify')}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-8">
                            <button type="submit" class="btn btn-warning btn-lg">登 录</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
<!-- Javascript -->
<script src="<?php echo ADMIN_JS_URL; ?>/jquery-1.7.2.min.js"></script>
<script src="<?php echo ADMIN_JS_URL; ?>/scripts.js"></script>
</body>
</html>

