<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>跳转提示 - 房卡交易系统</title>
    <bootstrapcss/>
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
        <h1><i class="glyphicon glyphicon-info-sign"></i> {$message}{$error}</h1>
        <p class="lead">
            页面将在<b id="wait">{$waitSecond}</b>秒后<a id="href" href="{$jumpUrl}">跳转</a>
        </p>

    </div>
</div>
<bootstrapjs/>
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