<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style>
        .center {
            position: fixed;
            top: 50%;
            width:100%;
            height: 50%;
            -webkit-transform: translateY(-50%);
        }

        .desktop-top{
            background-color: #51e4ae;
            color: #FFFFFF;
        }

        .desktop-left{
            background-color: #333;
            color: #FFFFFF;
        }
    </style>
</head>
<body class="desktop-top">

<div>
<!--
    <span style="font-size:12px;"></span>访问&nbsp<a href="http://m.tp51.dev" target="_parent">手机端</a></span>&nbsp&nbsp&nbsp&nbsp 欢迎！{$loginInfo.os_account} <a href="{$logutUrl}" target="_top">退出</a>
-->
    <div style="align-content: center;text-align: right;" class="center"><div>&nbsp&nbsp&nbsp&nbsp♛ <?php echo $username;?>&nbsp&nbsp&nbsp<a href="<?php echo $logouturl; ?>" target="_top" style="color: #FFFFFF; text-decoration:none;border-left: 1px solid #eefbf7;">&nbsp&nbsp退出></a>&nbsp&nbsp&nbsp&nbsp</div>
</div>
</body>
</html>
