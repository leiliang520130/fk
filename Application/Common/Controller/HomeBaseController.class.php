<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * Home基类控制器
 */
class HomeBaseController extends BaseController{
	/**
	 * 初始化方法
	 */
	public function _initialize(){
		parent::_initialize();

		if(!check_login()){
		    $this->error('你还没有登录,请登录!',U('Home/Index/index'));
        }

	}




}

