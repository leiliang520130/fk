<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>跳转提示 - 房卡交易系统</title>
        <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="/Public/statics/font-awesome-4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/tpl/Public/css/base.css" />
    <style>
        .jumbotron{
            margin-top: 50px;
            color: white;
            background-color: #5cb85c;
            border-color: #4cae4c;
        }
        .glyphicon-info-sign{
            font-size: 3rem;
            color: #ec971f;
            border-color: #d58512;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1><i class="glyphicon glyphicon-info-sign"></i> <?php echo ($message); echo ($error); ?></h1>
        <p class="lead">
            页面将在<b id="wait"><?php echo ($waitSecond); ?></b>秒后<a id="href" href="<?php echo ($jumpUrl); ?>">跳转</a>
        </p>

    </div>
</div>
<!-- 引入bootstrjs部分开始 -->
<script src="/Public/statics/js/jquery-1.10.2.min.js"></script>
<script src="/Public/statics/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="/tpl/Public/js/base.js"></script>
<script type="text/javascript">
    (function () {
        var wait = document.getElementById('wait'), href = document.getElementById('href').href;
        var interval = setInterval(function () {
            var time = --wait.innerHTML;
            if (time <= 0) {
                location.href = href;
                clearInterval(interval);
            }
            ;
        }, 1000);
    })();
</script>
</body>
</html>