<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>代理个人后台</title>
        <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="/Public/statics/font-awesome-4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/tpl/Public/css/base.css" />
    <style type="text/css">
        body{
            background: #eee;
        }
        .my-btn{
            margin-bottom: 20px;
        }
        .row{
            background: white;
            padding: 5%;
            margin: 2%;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .tow-btn{
            margin-bottom: 20px;
            font-size: 12px;
        }
        .b-page {
            background: #fff;
            box-shadow: 0px 1px 2px 0px #E2E2E2;
        }
        .page {
            width: 100%;
            padding: 30px 15px;
            background: #FFF;
            text-align: center;
            overflow: hidden;
        }
        .page .first,
        .page .prev,
        .page .current,
        .page .num,
        .page .current,
        .page .next,
        .page .end {
            padding: 8px 16px;
            margin: 0px 5px;
            display: inline-block;
            color: #008CBA;
            border: 1px solid #F2F2F2;
            border-radius: 5px;
        }
        .page .first:hover,
        .page .prev:hover,
        .page .current:hover,
        .page .num:hover,
        .page .current:hover,
        .page .next:hover,
        .page .end:hover {
            text-decoration: none;
            background: #F8F5F5;
        }
        .page .current {
            background-color: #008CBA;
            color: #FFF;
            border-radius: 5px;
            border: 1px solid #008CBA;
        }
        .page .current:hover {
            text-decoration: none;
            background: #008CBA;
        }
        .page .not-allowed {
            cursor: not-allowed;
        }
        @media (max-width: 768px) {
            .page .first{
                display: none;
            }
            .page .end{
                display: none;
            }
            .page .rows{
                display: none;
            }
            .page .num{
                display: none;
            }

        }

    </style>
    
    <style>
        .row h4{
            height: 200px;
            width: 294px;
            text-align: center;
            display: table-cell;
            vertical-align:middle;

        }

    </style>

</head>
<body>

<div class="container">
    
    <h3 style="text-align: center;margin-top: 10px">卖给代理记录</h3>
    <div class="row">
        <form style="margin-bottom: 20px;margin-top: 20px" class="form-inline" method="get" action="/Home/User/sale_list" id="">
            <div class="form-group">
                <label for="txtStartDate">开始时间</label>
                <input id="txtStartDate" style="height: 34px;width: 100%;-webkit-appearance:none;" class="" type="date" placeholder="请输入开始时间" value="<?php echo I('start', '');?>" name="start"/>
            </div>
            <div class="form-group">
                <label for="txtEndDate">结束时间</label>
                <input id="txtEndDate" style="height: 34px;width: 100%;-webkit-appearance:none;" class="" type="date"  placeholder="请输入结束时间" name="end" value="<?php echo I('end', '');?>"/>
            </div>
            <button type="submit" style="width: 100%" class="btn btn-info  btn-sm">查询</button>
        </form>
        <table class="table table-striped">
            <tr>
                <td>卖出ID</td>
                <td>购卡数量</td>
                <td>购卡时间</td>
            </tr>
            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
                    <td><?php echo ($vo["pcode"]); ?></td>
                    <td><?php echo ($vo["num"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                </tr><?php endforeach; endif; ?>
        </table>
        <?php echo ($page); ?>
    </div>


    
    <div class="row">
        <a href="<?php echo U('Home/User/index');?>" class="btn btn-primary col-xs-12 my-btn btn-lg" type="submit">返回首页</a>
    </div>

</div> <!-- /container -->

<!-- 引入bootstrjs部分开始 -->
<script src="/Public/statics/js/jquery-1.10.2.min.js"></script>
<script src="/Public/statics/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="/tpl/Public/js/base.js"></script>
<!--<script src="/Public/statics/layer/layer.js"></script>-->
<script src="/Public/statics/layer_mobile/layer.js"></script>







</body>
</html>