<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>
        代理申请审核
    </title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="/Public/statics/aceadmin/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/Public/statics/aceadmin/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/Public/statics/font-awesome-4.4.0/css/font-awesome.min.css"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="/Public/statics/aceadmin/css/font-awesome-ie7.min.css"/><![endif]-->
    <link rel="stylesheet" href="/Public/statics/aceadmin/css/ace.min.css"/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/Public/statics/aceadmin/css/ace-ie.min.css"/><![endif]--><!--[if lt IE 9]>
    <script src="/Public/statics/aceadmin/js/html5shiv.js"></script>
    <script src="/Public/statics/aceadmin/js/respond.min.js"></script><![endif]-->
    <link rel="stylesheet" href="/tpl/Public/css/base.css"/>
    <style type="text/css">
        #sidebar .nav-list {
            overflow-y: auto;
        }

        .b-nav-li {
            padding: 5px 0;
        }

        .uri-active::before {
            content: "\f101";
        }

    </style>
    
</head>
<body>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left"><a href="#" class="navbar-brand">
            <small><i class="icon-leaf"></i>房卡系统</small>
        </a></div>
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><img
                        class="nav-user-photo" src="/Public/statics/aceadmin/avatars/avatar2.png" alt="Jason's Photo"/> <span
                        class="user-info"><small>欢迎光临,</small> <?php echo ($_SESSION['user']['username']); ?></span><i
                        class="icon-caret-down"></i></a>
                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Admin/Index/Index');?>"><i class="icon-user"></i>个人信息</a></li>
                        <li><a href="<?php echo U('Home/Index/logout');?>"><i class="icon-off"></i> 退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner"><a class="menu-toggler" id="menu-toggler" href="#"><span class="menu-text"></span></a>
        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'fixed')
                } catch (e) {
                }
            </script>
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                    <button class="btn btn-success"><i class="icon-signal"></i></button>
                    <button class="btn btn-info"><i class="icon-pencil"></i></button>
                    <button class="btn btn-warning"><i class="icon-group"></i></button>
                    <button class="btn btn-danger"><i class="icon-cogs"></i></button>
                </div>
                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini"><span
                        class="btn btn-success"></span><span class="btn btn-info"></span><span
                        class="btn btn-warning"></span><span class="btn btn-danger"></span></div>
            </div><!-- #sidebar-shortcuts -->
            <ul class="nav nav-list" id="menu" data-url="/<?php echo ($rule_name); ?>">
                <?php if(is_array($nav_data)): foreach($nav_data as $key=>$v): if(empty($v['_data'])): ?><li class="b-nav-li"><a href="<?php echo U($v['mca']);?>"><i class="fa fa-<?php echo ($v['ico']); ?> icon-test"></i> <span
                                class="menu-text"><?php echo ($v['name']); ?></span></a></li>
                        <?php else: ?>
                        <li class="b-has-child"><a href="#" class="dropdown-toggle b-nav-parent"><i
                                class="fa fa-<?php echo ($v['ico']); ?> icon-test"></i> <span class="menu-text"><?php echo ($v['name']); ?></span><b
                                class="arrow icon-angle-down"></b></a>
                            <ul class="submenu">
                                <?php if(is_array($v['_data'])): foreach($v['_data'] as $key=>$n): ?><li class="b-nav-li"><a href="<?php echo U($n['mca']);?>" class="uri"><i
                                            class="icon-double-angle-right"></i> <?php echo ($n['name']); ?></a></li><?php endforeach; endif; ?>
                            </ul>
                        </li><?php endif; endforeach; endif; ?>
            </ul>
            <!--<div class="sidebar-collapse" id="sidebar-collapse"><i class="icon-double-angle-left"
                                                                   data-icon1="icon-double-angle-left"
                                                                   data-icon2="icon-double-angle-right"></i></div>-->
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {
                }
            </script>
        </div>
        <div class="main-content">
            <div class="page-content">
                
    <div class="page-header"><h1><i class="fa fa-home"></i>代理申请审核</h1></div>
        <!--收索部分开始-->

        <form class="form-inline" method="get" action="/Admin/Manage/index" id="com_from">
            <div class="form-group">
                <label for="exampleInputName2">手机号码</label>
                <input type="text" class="form-control" id="exampleInputName2" name="phone" value="<?php echo I('phone', '');?>" placeholder="请输入手机号码">
            </div>
            <div class="form-group">
                <label>姓名</label>
                <input type="email" class="form-control"  name="name" value="<?php echo I('username', '');?>" placeholder="输入查找姓名">
            </div>
            <div class="form-group">
                <label>审核状态</label>
                <select name="status" class="form-control" id="status">
                    <option value="">未选择</option>
                    <option value="2">审核中</option>
                    <option value="1">已通过</option>
                </select>
            </div>
            <button type="submit" class="btn btn-info btn-sm" style="margin-top: 19px">搜索</button>
        </form>
        <!--收索结束-->

        <table class="table table-bordered">
            <tr class="active">
                <td>序号</td>
                <td>手机号码</td>
                <td>姓名</td>
                <td>代理理级别</td>
                <td>上级代理ID(姓名)</td>
                <td>申请时间</td>
                <td>审核状态</td>
                <td>操作</td>

            </tr>

            <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr class="odd gradeX">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["phone"]); ?></td>
                    <td><?php echo ($vo["username"]); ?></td>
                    <td><?php echo ($vo["level"]); ?>级代理</td>
                    <td><?php echo ($vo["pid"]); ?> (<?php echo ($vo["uname"]); ?>)</td>
                    <td><?php echo date('Y-m-d H:i', $vo['register_time']);?></td>
                    <td>
                        <?php if(($vo["status"]) == "2"): ?><button class='btn btn-sm btn-info' onclick="audit(1,'<?php echo ($vo["id"]); ?>')" >点击审核</button>
                            <?php else: ?>
                            <span>审核通过</span><?php endif; ?>
                    </td>
                    <td>
                        <?php if(($vo["status"]) == "1"): ?><button class='btn btn-danger btn-sm' onclick="audit(2,'<?php echo ($vo["id"]); ?>')" >取消代理</button><?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; ?>
        </table>
        <?php echo ($page); ?>
    </div>

            </div>
        </div>
    </div>
    <!--<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"><i
            class="icon-double-angle-up icon-only bigger-110"></i></a>--></div><!--[if !IE]> -->
<script src="/Public/statics/js/jquery-1.10.2.min.js"></script><!-- <![endif]--><!--[if IE]>
<script src="/Public/statics/js/jquery-1.10.2.min.js"></script><![endif]--><!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='/Public/statics/aceadmin/js/jquery-2.0.3.min.js'>" + "<" + "script>");
</script><!-- <![endif]--><!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='/Public/statics/aceadmin/js/jquery-1.10.2.min.js'>" + "<" + "script>");
</script><![endif]-->
<script type="text/javascript">
    if ("ontouchend" in document) document.write("<script src='/Public/statics/aceadmin/js/jquery.mobile.custom.min.js'>" + "<" + "script>");


    var menu = $("#menu").attr('data-url');
    //console.log(menu);
    $(".uri").each(function () {
        var href = $(this).attr('href');
        //console.log(menu);
        if (menu == href) {
            $(this).closest(".submenu").css('display', 'block');
            $(this).closest(".b-nav-li").addClass('uri-active');
            $(this).closest(".submenu").css('display', 'block');
            //var s = $(this).addClass("");
            $(this).css('color', '#1963aa');
            //$(this).addClass('uri-active');
            $(this).addClass('fa fa-play');
        }
    });


</script>
<script src="/Public/statics/aceadmin/js/typeahead-bs2.min.js"></script>
<script src="/Public/statics/aceadmin/js/bootstrap.min.js"></script>
<!--[if lte IE 8]>
<script src="/Public/statics/aceadmin/js/excanvas.min.js"></script><![endif]-->
<script src="/Public/statics/aceadmin/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="/Public/statics/aceadmin/js/jquery.ui.touch-punch.min.js"></script>
<script src="/Public/statics/aceadmin/js/jquery.slimscroll.min.js"></script>
<script src="/Public/statics/aceadmin/js/jquery.easy-pie-chart.min.js"></script>
<script src="/Public/statics/aceadmin/js/jquery.sparkline.min.js"></script>
<script src="/Public/statics/aceadmin/js/flot/jquery.flot.min.js"></script>
<script src="/Public/statics/aceadmin/js/flot/jquery.flot.pie.min.js"></script>
<script src="/Public/statics/aceadmin/js/flot/jquery.flot.resize.min.js"></script>
<script src="/Public/statics/aceadmin/js/ace-elements.min.js"></script>
<script src="/Public/statics/aceadmin/js/ace.min.js"></script>
<script src="/tpl/Public/js/base.js"></script>
<script src="/Public/statics/layer/layer.js"></script>

    <script>



        //回显示select
        $(function () {

            var status = "<?php echo I('get.status');?>";
            if(status != null || status != ''){
                $('#status').val([status]);
            }
        });

        function audit(type,id) {
            if(type == 1) {
                var msg = '您确定要审核通过吗?';
            }else{
                var msg = '您确定要取消代理吗,用户将无法登陆!';
            }
            layer.confirm(msg, {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("<?php echo U('Manage/audit');?>",{id:id,type:type},function(r){
                    if(r.code == 0) {
                        layer.msg('操作成功',{icon:1,time:1000});
                        setTimeout(function () {
                            window.location.reload(true);
                        }, 1000);
                    }else{
                        layer.msg('操作失败，请重试',{icon:2,time:1000});
                    }
                },'json')
            }, function(){
            });
        }


    </script>


</body>
</html>