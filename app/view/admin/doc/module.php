<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

</head>
<body>
    <form method="post" action="/admin/document/save.html" id="doc-form">
        <div style="height: 38px; width:100%;"><input type="button" onclick="_submit()" value="发布" style="height: 30px;width:50px;background-color: #2295e6;position: absolute;right: 8px;"></div>

        <div>文档标题：<input type="text" value="" name="title" style="width: 100%;height: 28px; font: inherit;"></div><br/>
        <div>选择文章：
            <select>
                <?php foreach ($doc_list as $v){ ?>
                    <option><?php echo $v['title'];?></option>
                <?php } ?>
            </select>
        <div>选择父级：
            <select>
                <?php foreach ($cat_list as $v){ ?>
                    <option><?php echo $v['name'];?></option>
                <?php } ?>
            </select>
        </div><br/>
        <br/>
    </form>
</body>
<script src="<?php echo DOCUMENT_ROOT; ?>js/jquery-1.11.3.js"></script>
<script src="<?php echo DOCUMENT_ROOT; ?>js/ueditor/ueditor.config.js"></script>
<script src="<?php echo DOCUMENT_ROOT; ?>js/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">

    function _submit() {
        var _obj = $("#doc-form");
        $.post(_obj.attr('action'),_obj.serialize(),function (e) {
            if(e.code == 'succ')
            {
                alert(e.msg);
                window.history.go(0);
            }else
                alert(e.msg);
        },'json')
    }
</script>
</html>
