<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body style="margin: 0px;">
    <table style="width: 100%;" border="0" cellspacing="0">
        <tr style="height: 30px;background-color: #a0afd0;">
            <th>操作</th>
            <th>文档标题</th>
            <th>发布状态</th>
            <th>发布时间</th>
            <th>更新时间</th>
        </tr>
        <?php foreach ($result as $val){ ?>
            <tr style="background-color: #ece7e7;height: 28px; text-align: center;">
                <td><a href="">查看</a> |  <a href="/admin/doc/update/status.html?u=<?=$val['start_status']?>&id=<?=$val['doc_id']?>"><?php echo $val['start_status'] == 'Y'?'关闭':'开启'; ?></a> </td>
                <td><?php echo strlen($val['title']) > 30 ? mb_substr($val['title'],0,30).'...':$val['title']; ?></td>
                <td><?php echo $val['start_status'] == 'Y'?'启用':'禁用'; ?></td>
                <td><?php echo date('Y-m-d H:i:s',$val['savetime']); ?></td>
                <td><?php echo date('Y-m-d H:i:s',$val['updatetime']); ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
<script src="<?php echo DOCUMENT_ROOT; ?>js/jquery-1.11.3.js"></script>
<script type="text/javascript">

</script>
</html>
