<?php
/**
 * Created by PhpStorm.
 * User: joy
 * Date: 2017/9/11
 * Time: 17:42
 */

namespace Admin\Controller;
use Common\Controller\AdminBaseController;

class CardController extends AdminBaseController
{
    //房卡购买记录
    public function index(){

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
    //房卡卖给代理
    public function sale(){
        $user = session('user');
        $user = M('Users')->where("id={$user['id']}")->find();
        $this->assign('user',$user);
        $this->display();
    }
    //房卡交易处理
    /*
     * 1.获取用户转卡的ID和数量
     * 2.判断数据的有效性
     * 3.判断是否满足推荐关系转卡和总代可以向任何人
     * */
    public function buy(){

        $post = I('post.');
        $user = session('user');
        $user = M('Users')->where("id={$user['id']}")->find();
        $pid = intval($post['pid']);
        $num = intval($post['num']);
        $remark = $post['remark'];
        //转账人信息
        $toUser = M('Users')->where("code=$pid")->find();
        if(!$toUser){
            die(json_encode(array('code'=>2,'msg'=>'代理ID不存在')));
        }
        if($user['code'] == '100001'){
            if($toUser['pid'] == 0){
                die(json_encode(array('code'=>2,'msg'=>'你没有代理此ID,无法售卡')));
            }
        }else{
            if($toUser['pid'] != $user['code']){
                die(json_encode(array('code'=>2,'msg'=>'你没有代理此ID,无法售卡')));
            }
        }

        $card = $user['num'] - $num;

        if($card < 0){
            die(json_encode(array('code'=>2,'msg'=>'库存不足无法交易')));
        }
        //进行转账交易事务处理
        M()->startTrans();
        $result = M('Users')->where("id={$user['id']}")->setDec('num',$num);
        $result1 = M('Users')->where("id={$toUser['id']}")->setInc('num',$num);
        $data['uid'] = $user['id'];
        $data['pcode'] = $pid;
        $data['num'] = $num;
        $data['type'] = 1;
        $data['time'] = time();
        $data['remark'] = $remark;
        //必须插入成功
        $result2 = M('Info')->add($data);
        //被转账人日志
        $map['uid'] = $toUser['id'];
        $map['pcode'] = $user['code'];
        $map['num'] = $num;
        $map['type'] = 2;
        $map['time'] = time();
        $map['remark'] = $remark;
        //事务的支持
        $result3 = M('Info')->add($map);
        if(!empty($result) && !empty($result1) && !empty($result2) && !empty($result3)){
            M()->commit();
            die(json_encode(array('code'=>0,'msg'=>'成功')));
        }else{
            M()->rollback();
            die(json_encode(array('code'=>1,'msg'=>'系统繁忙,稍后再试!')));
        }
        //记录日志
        //转账人的日志
        //添加事务的操作




    }
    //房卡卖给玩家页面显示
    public function play(){
        $user = session('user');
        $user = M('Users')->where("id={$user['id']}")->find();
        $this->assign('user',$user);
        $this->display();
    }
    //玩家充值接口  玩家回调接口需要定时任务处理,修改数据库状态
    public function play_buy(){
        //待确认玩家充值方案
        $post = I('post.');
        $user = session('user');
        $user = M('Users')->where("id={$user['id']}")->find();
        $play_id = intval($post['pid']);
        $num = intval($post['num']);
        $remark = $post['remark'];
        //转账人信息

        $card = $user['num'] - $num;

        if($card < 0){
            die(json_encode(array('code'=>2,'msg'=>'库存不足无法交易')));
        }
        //进行转账交易事务处理
        M()->startTrans();
        //减少库存
        $result = M('Users')->where("id={$user['id']}")->setDec('num',$num);
        //插入日志1
        $data['uid'] = $user['id'];
        $data['pcode'] = $play_id;
        $data['num'] = $num;
        $data['type'] = 3;
        $data['time'] = time();
        $data['remark'] = $remark;
        //必须插入成功
        $result1 = M('Info')->add($data);
        //事务的支持
        if(!empty($result) && !empty($result1)){
            M()->commit();
            die(json_encode(array('code'=>0,'msg'=>'成功')));
        }else{
            M()->rollback();
            die(json_encode(array('code'=>1,'msg'=>'系统繁忙,稍后再试!')));
        }
    }

    //会员审核
    public function renzheng() {
        $id = I('id');
        $type=I('type',0);

        if(M('user')->where(array('id'=>$id))->save(array('status'=>$type))!==false){
            die(json_encode(array('code'=>0)));
        }else{
            die(json_encode(array('code'=>-1)));
        };

    }

    //房卡卖出记录
    public function sell(){
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
        //echo $filter;

        $data = get_page_data(M('Info'),$filter,'time desc',2);
        //echo M('Info')->getLastSql();
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
        //echo $filter;

        $data_play = get_page_data(M('Info'),$filter1,'time desc',2);
        //封装数据传到前端
        //echo M('Info')->getLastSql();exit;
        //var_dump($data_play);exit;
        $data = [
            'data' => $data,
            'data_play' => $data_play
        ];
        //var_dump($data_play);
        $this->assign($data);
        //$this->assign($data_play);
        $this->display();

    }



}