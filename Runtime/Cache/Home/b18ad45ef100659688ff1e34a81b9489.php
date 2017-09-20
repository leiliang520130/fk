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
        .input-group{
            margin-bottom: 20px;
        }
    </style>

</head>
<body>

<div class="container">
    
    <h3 style="text-align: center;margin-top: 10px;color: #3e8f3e;">卖卡给代理 </h3>
    <div class="row">
        <form class="form-inline">
            <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" style="width: 112px" type="button">可售房卡数量:</button>
                    </span>
                <input type="text" value="<?php echo ($user["num"]); ?>"  class="form-control" readonly>
            </div>
            <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" style="width: 112px" type="button">买方代理 ID:</button>
                    </span>
                <input type="number" name="pid" placeholder="输入买方代理ID"  class="form-control">
            </div>
            <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">&nbsp;&nbsp;&nbsp;卖出卡数量:</button>
                    </span>
                <input type="number" name="num" placeholder="输入卖给代理房卡数量"  class="form-control">
            </div>
            <div class="input-group bz">
                    <span class="input-group-btn">
                        <button class="btn btn-default" style="height: 54px;width: 112px" type="button">备注:</button>
                    </span>
                <textarea placeholder="这里可输入备注信息!" class="form-control" id="remark" name="remark" rows="2"></textarea>
            </div>
        </form>
        <button class="btn btn-success col-xs-12 my-btn btn-lg" type="submit" id="sub">确定卖卡</button>
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


    <script>
        $(function () {
            $("#sub").on('click',function () {
                var pid = $('input[name=pid]').val();
                var num = $('input[name=num]').val();
                var remark = $('#remark').val();
                if(pid == '') {
                    layer.open({
                        content: '请输入代理ID'
                        ,skin: 'msg'
                        ,time: 2
                    });
                    return false;
                }
                if(num == '') {
                    layer.open({
                        content: '请输入房卡数量'
                        ,skin: 'msg'
                        ,time: 2
                    });
                    return false;
                }
                var r = /^[0-9]*[1-9][0-9]*$/;
                if(!r.test(num)){
                    layer.open({
                        content: '数量必须为正整数'
                        ,skin: 'msg'
                        ,time: 2
                    });
                    return false;
                }
                layer.open({
                    content: '请确认信息是否正确,误充值房卡不可退回？'
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        $.post("<?php echo U('Admin/Card/buy');?>",{pid:pid,num:num,remark:remark},function(r){
                            if(r.code == 0) {
                                layer.open({
                                    content: '操作成功'
                                    ,skin: 'msg'
                                    ,time: 2
                                });
                                setTimeout(function () {
                                    window.location.href="<?php echo U('Home/User/index');?>";
                                }, 1000);
                            }else{
                                layer.open({
                                    content: r.msg
                                    ,skin: 'msg'
                                    ,time: 2
                                });
                            }
                        },'json');
                        layer.close(index);
                    }
                });


            })


        })


    </script>




</body>
</html>