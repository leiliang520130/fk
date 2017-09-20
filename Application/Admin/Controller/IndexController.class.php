<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页控制器
 */
class IndexController extends AdminBaseController{
	/**
	 * 首页
	 */
	public function index(){

	    $user = session('user');
	    //每次及时刷新用户信息(后期需优化,不需要额外的数据库开销)
        $user = M('Users')->where("id={$user['id']}")->find();
        //累计购卡的
        $user_id = $user['id'];
        $card_all = M('Info')->where(['uid'=>$user_id,'type'=>2])->sum('num');
        //获取上级信息
        $pid = M('Users')->where("code={$user['pid']}")->find();
        $this->assign('pid',$pid);
        $this->assign('user',$user);
        $this->assign('card_all',$card_all);
		$this->display();
	}
	/**
	 * elements
	 */
	public function elements(){

		$this->display();
	}
	
	/**
	 * welcome
	 */
	public function welcome(){
	    $this->display();
	}



}
