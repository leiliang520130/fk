<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>代理申请</title>
        <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/statics/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="/Public/statics/font-awesome-4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/tpl/Public/css/base.css" />
    <style>
        body {
            padding-top: 10px;
            padding-bottom: 10px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 1200px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin-heading{
            text-align: center;
            margin-bottom: 10px;
        }
        .form-signin,
        .form-signin{
            margin-bottom: 10px;

        }
        .form-signin{
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        #Submit{
            height: 40px;
        }
    </style>
</head>
<body>

<div class="container">

    <!--<form class="form-signin">
        <h2 class="form-signin-heading">代理申请</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-info btn-block" type="submit">提交审核</button>
    </form>-->

    <form id="userInfoForm" class="form-horizontal form-signin" method="post" action="">
        <h2 class="form-signin-heading">代理申请</h2>
        <div class="form-group">
            <label class="col-sm-5 control-label">用户名：</label>
            <div class="col-sm-3">
                <input type="text" name="phone" class="form-control" placeholder="请输入手机号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" name="password" placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">确认密码：</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" name="password_1" placeholder="请输入再次密码，确保一致">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">姓名：</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="username" placeholder="请输入你的姓名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">推广代理ID：</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="pid" placeholder="输入推广人ID">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">微信号：</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="weixin" placeholder="输入你的微信">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label"></label>
            <div class="col-sm-3">
                <input type="submit" id="Submit" class="btn btn-success" style="width: 100%" value="提交审核">
            </div>
        </div>
    </form>

</div> <!-- /container -->

<!-- 引入bootstrjs部分开始 -->
<script src="/Public/statics/js/jquery-1.10.2.min.js"></script>
<script src="/Public/statics/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="/tpl/Public/js/base.js"></script>

<link rel="stylesheet" href="/Public/statics/bootstrapvalidator/bootstrapValidator.min.css">
<script src="/Public/statics/bootstrapvalidator/bootstrapValidator.min.js"></script>
<script src="/Public/statics/bootstrapvalidator/zh_CN.js"></script>

<script>
    $("#userInfoForm").bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields:{
            //用户名手机号码
            phone:{
                message: 'The phone is not valid',
                validators: {
                    notEmpty: {
                        message: '手机号码不能为空'
                    },
                    stringLength: {
                        min: 11,
                        max: 11,
                        message: '请输入11位手机号码'
                    },
                    regexp: {
                        regexp: /^1\d{10}$/,
                        message: '请输入正确的手机号码'
                    }
                }
            },
            //密码验证
            password:{
                message: '',
                validators:{
                    notEmpty: {
                        message: '密码不能为空！'
                    },
                    stringLength:{
                        min:6,
                        max:12,
                        message:'用户名长度必须在6到12位之间'
                    }
                }
            },
            //确认密码
            password_1:{
                message: '',
                validators:{
                    notEmpty: {
                        message: '请确认与上面密码一致'
                    },
                    identical: {
                        field: 'password',
                        message: '两次密码不一致'
                    }

                }
            },
            username:{
                message: '',
                validators:{
                    notEmpty: {
                        message: '姓名不能为空'
                    },
                    stringLength: {
                        min: 1,
                        max: 10,
                        message: '姓名长度必须在1到10之间'
                    }
                }
            },
            pid:{
                message: '',
                validators:{
                    notEmpty: {
                        message: '输入推广人ID,不能为空'
                    }
                }
            }
        }
    })
   /* .on('success.form.bv',function () {
        var datas=$("#userInfoForm").serialize();
        console.log(datas)

    });*/

</script>

</body>
</html>