<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <script src="<?php echo DOCUMENT_ROOT; ?>js/jquery-1.11.3.js"></script>
</head>
<style>
    ul li
    {
        list-style-type:none;
    }
    a
    {
        text-decoration:none;
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
<body class="desktop-left">
<div id="admin-menus">
    <ul>
        <?php foreach((array)$menu as $v){ ?>
        <li>
            <p class="top-level-menu"><?php echo $v['name']; ?> <span>▲</span></p>
            <div style="display: none">
                <?php foreach ((array)$v['sublevel'] as $sv){ ?>
                <p style="font-size: 16px;">
                    <a style="color: lavender;" href="<?php echo $sv['href']; ?>" target="frame_center"><?php echo $sv['name']; ?> ☞</a>
                </p>
                <?php } ?>
            </div>
        </li>
        <?php } ?>

    </ul>
</div>
<script>
$(document).ready(function(){
    $(".top-level-menu").click(function(){
        $(".top-level-menu").next('div').hide();
        $(".top-level-menu").contents('span').html('▲');
        $(this).contents('span').html('▼');
        $(this).next('div').show();
    });
})
</script>
</body>
</html>
