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
    .col-xs-4{
        font-size: 12px;
    }
</style>

</head>
<body>

<div class="container">
    
    <h3 style="text-align: center;margin-top: 10px">欢迎进入后台代理</h3>
   <div class="row">

       <form class="form-inline">
           <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" style="width: 122px" type="button">我的代理ID:</button>
                    </span>
               <input type="text" value="<?php echo ($user["code"]); ?>"  class="form-control" readonly>
           </div>
           <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" style="width: 122px" type="button">可售的房卡数量:</button>
                    </span>
               <input type="text" value="<?php echo ($user["num"]); ?>"  class="form-control" readonly>
           </div>
           <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" style="width: 122px" type="button">累计购卡:</button>
                    </span>
               <input type="text" value="<?php echo ((isset($card_all) && ($card_all !== ""))?($card_all):'0'); ?>"  class="form-control" readonly>
           </div>
       </form>

       <!--<button class="btn btn-default col-xs-12 my-btn" type="submit">我的代理ID:<?php echo ($user["code"]); ?></button>
       <button class="btn btn-default col-xs-12 my-btn" type="submit">可售的房卡数量:<?php echo ($user["num"]); ?></button>
       <button class="btn btn-default col-xs-12 my-btn" type="submit">累计购卡:<?php echo ((isset($card_all) && ($card_all !== ""))?($card_all):"0"); ?></button>-->
       <a href="<?php echo U('Home/User/buy');?>" class="btn btn-info col-xs-4  btn-lg" type="submit">购买房卡</a>
       <a href="<?php echo U('Home/User/play');?>" class="btn btn-info col-xs-4  btn-lg" type="submit">卖给玩家</a>
       <a href="<?php echo U('Home/User/sale');?>" class="btn btn-info col-xs-4  btn-lg" type="submit">卖给代理</a>
   </div>

    
    <div class="row">
        <!--<a href="<?php echo U('Home/User/index');?>" class="btn btn-primary col-xs-3 tow-btn" type="submit">用户中心</a>-->
        <a href="<?php echo U('Home/User/buy_list');?>" class="btn btn-info col-xs-12 my-btn btn-lg" >购买房卡记录</a>
        <a href="<?php echo U('Home/User/sale_play_list');?>" class="btn btn-info col-xs-12 my-btn btn-lg" >卖给玩家记录</a>
        <a href="<?php echo U('Home/User/sale_list');?>" class="btn btn-info col-xs-12 my-btn btn-lg" >卖给代理记录</a>
        <a href="<?php echo U('Home/Index/logout');?>" class="btn btn-danger col-xs-12 my-btn btn-lg" >退出登录状态</a>
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