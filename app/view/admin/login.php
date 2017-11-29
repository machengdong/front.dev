<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo DOCUMENT_ROOT; ?>css/admin.login.page.css">
</head>
<body class="login-page" style="">
<div class="login-box">
    <div class="login-logo">
        <b>胜不了的是自己</b>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Login</p>
        <form action="/admin/Passport.html" method="post">
            <div class="form-group has-feedback 1">
                <input type="input" class="form-control" placeholder="Username" name="username" value="">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback 1">
                <input type="password" class="form-control" placeholder="Password" name="password" value="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-offset-4">
                    <input type="hidden" name="_token" value="yemtwnoQ1GcJsFHnXg8sjMhaj8h6a0GcBdsS4iQN">
                    <button type="button" class="btn btn-primary btn-block btn-flat" id="submit-form">Login</button>
                </div>
            </div>
        </form>

    </div>
</div>
</body>
<script src="<?php echo DOCUMENT_ROOT; ?>js/jquery-1.11.3.js"></script>
<script type="text/javascript">
    var popup={
        hint :null,
        message: function (content, url) {
            if (popup.hint == null) {
                popup.hint = '<div id="pop-up" style="z-index:9999;top: 35%;left: 36%;width:28%;position: fixed;background:none;bottom:10%;"> <p class="pop-up" style="background: none repeat scroll 0 0 #000; border-radius: 30px;color: #fff; margin: 0 auto;padding: 1.5em;text-align: center;width: 70%;opacity: 0.8; font-family:Microsoft YaHei;letter-spacing: 1px;font-size: 1.5em;"></p></div>';
                $(document.body).append(popup.hint);
            }
            $("#pop-up").show();
            $(".pop-up").html(content);
            if (url) {
                window.setTimeout("location.href='" + url + "'", 1500);
            } else {
                setTimeout('$("#pop-up").fadeOut()', 1500);
            }
        }
    }
$(document).ready(function(){

    $("#submit-form").click(function()
    {
        if(!$("input[name='username']").val())
        {
            popup.message('用户名不能为空！');
            return false;
        }
        if(!$("input[name='password']").val())
        {
            popup.message('密码不能为空');
            return false;
        }

        $.post(
                $(".login-box-body form").attr('action'),
                $(".login-box-body form").serialize(),
                function(e) {
                    if(e.code == 'succ')
                    {
                        popup.message('登陆成功','/admin/desktop/main.html');
                    }else{
                        popup.message(e.msg);
                    }
                },'json'
        );
    });
});
</script>
</html>
