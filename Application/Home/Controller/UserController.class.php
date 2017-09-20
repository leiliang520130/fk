<?php
/**
 * Created by PhpStorm.
 * User: joy
 * Date: 2017/9/15
 * Time: 18:08
 */

namespace Home\Controller;


use Common\Controller\HomeBaseController;

class UserController extends HomeBaseController
{
    //个人中心展示页面
    public function index(){


        $user = session('user');
        //每次及时刷新用户信息(后期需优化,不需要额外的数据库开销)
        $user = M('Users')->where("id={$user['id']}")->find();
        //累计购卡的
        $user_id = $user['id'];
        $card_all = M('Info')->where(['uid'=>$user_id,'type'=>2])->sum('num');
        //获取上级信息

        $this->assign('user',$user);
        $this->assign('card_all',$card_all);
        $this->display();
    }


    //购买房卡显示信息
    public function buy(){
        $user = session('user');
        $pid = M('Users')->where("code={$user['pid']}")->find();
        $this->assign('pid',$pid);
        $this->display();
    }

    //前台房卡卖给代理展示页面 接口都是调用后台的交易接口
    public function sale(){
        $user = session('user');
        $user = M('Users')->where("id={$user['id']}")->find();
        $this->assign('user',$user);
        $this->display();
    }

    //前台房卡卖给玩家的展示页面

    public function play(){
        $user = session('user');
        $user = M('Users')->where("id={$user['id']}")->find();
        $this->assign('user',$user);
        $this->display();
    }

    //购买记录显示

    public function buy_list(){
        //筛选条件
        $filter=' type = 2';
        //筛选条件
        $start_time = I('start', '');
        $end_time = I('end', '');

        if($start_time && $end_time) {
            $filter .= " AND time>=".strtotime($start_time)." AND time <=".strtotime($end_time." 23:59:59");
        }else if($start_time) {
            $filter .= " AND time>=".strtotime($start_time);
        }else if($end_time) {
            $filter .= " AND time<=".strtotime($end_time." 23:59:59");
        }
        $user = session('user');
        $user_id = $user['id'];
        $filter .= " AND uid = $user_id";
        //获取数据
        //echo $filter;

        $data = get_page_data(M('Info'),$filter,'time desc',2);
        //echo M('Info')->getLastSql();
        $this->assign($data);
        $this->display();
    }

    //卖给代理记录
    public function sale_list(){
        //房卡卖给代理
        //筛选条件
        $filter=' type = 1';
        //筛选条件
        $start_time = I('start', '');
        $end_time = I('end', '');

        if($start_time && $end_time) {
            $filter .= " AND time>=".strtotime($start_time)." AND time <=".strtotime($end_time." 23:59:59");
        }else if($start_time) {
            $filter .= " AND time>=".strtotime($start_time);
        }else if($end_time) {
            $filter .= " AND time<=".strtotime($end_time." 23:59:59");
        }
        $user = session('user');
        $user_id = $user['id'];
        $filter .= " AND uid = $user_id";
        //获取数据
        $data = get_page_data(M('Info'),$filter,'time desc',2);
        $this->assign($data);
        $this->display();
    }

    //房卡卖给玩家记录

    public function sale_play_list(){
        //获取当前登录用户id
        $user = session('user');
        $user_id = $user['id'];
        //房卡卖给玩家
        $filter1= "uid = $user_id";
        //筛选条件
        $start_time1 = I('start1', '');
        $end_time1 = I('end1', '');

        if($start_time1 && $end_time1) {
            $filter1 .= " AND time>=".strtotime($start_time1)." AND time <=".strtotime($end_time1." 23:59:59");
        }else if($start_time1) {
            $filter1 .= " AND time>=".strtotime($start_time1);
        }else if($end_time1) {
            $filter1 .= " AND time<=".strtotime($end_time1." 23:59:59");
        }
        //$user1 = session('user');
        //$user_id1 = $user1['id'];
        $filter1 .= " AND type IN(3,4)";//充值给玩家的状态
        //获取数据
        $data_play = get_page_data(M('Info'),$filter1,'time desc',2);

        $this->assign($data_play);
        $this->display();

    }







}