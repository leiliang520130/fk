<?php
namespace Home\Controller;
use Common\Controller\BaseController;
use function Sodium\add;

/**
 * 商城首页Controller
 */
class IndexController extends BaseController{


	/**
	 * 首页
	 */
	public function index(){
        if(IS_POST){
            //做一个简单的登录 组合where数组条件
            $map=I('post.');
            $map['password']=md5($map['password']);
            $data=M('Users')->where($map)->find();
            //echo M('Users')->getLastSql();exit;
            if (empty($data)) {
                $this->error('账号或密码错误');
            }
            if($data['status'] == 2){
                $this->error('账号未激活，请联系管理员激活');
            }
            if($data['status'] == 0){
                $this->error('账号已停用，请联系管理员处理');
            }
            //通过登录验证跳转系统
            $_SESSION['user']= $data;
            if(is_mobile()){
                $this->success('登录成功正在进入房卡交易系统...',U('Home/User/index'));
            }else{
                $this->success('登录成功正在进入房卡交易系统...',U('Admin/Index/index'));
            }


        }else{
            $data=check_login() ? $_SESSION['user']['username'].'已登录' : '未登录';
            $assign=array(
                'data'=>$data
                );
            $this->assign($assign);
            $this->display();
        }
	}

	public function register(){
        /*$sql = "INSERT INTO `__UUID__` (`uuid`) VALUES (100001)";
        for($a=100002;$a<110001;$a++){

                $sql .= ",(".$a.")";
        }
        echo $sql;exit;*/

 /*       $sql = "SELECT t1.*
FROM `__UUID__` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `__UUID__`)-(SELECT MIN(id) FROM `__UUID__`))+(SELECT MIN(id) FROM `__UUID__`)) AS id) AS t2
WHERE t1.id >= t2.id
ORDER BY t1.id LIMIT 1;";*/
        
        //$arr = M('Uuid')->query($sql);//INSERT INTO `__UUID__` (`id`, `uuid`) VALUES ('3', '100003'),
        //var_dump($arr);exit;

        if(IS_POST){

            $data = I("post.");
            $phone = $data['phone'];
            //验证手机号码
            if($data['phone'] == null){
                $this->error("手机号不能为空");
            }
            //手机号码必须为1开头的正则
            if(!preg_match("/^1\d{10}$/",$phone)){
                $this->error("手机号不正确");
            }

            if(M('Users')->where(array('phone'=>$data['phone']))->find()){
                $this->error("手机号已被使用");
            }
            //验证用户名
            if($data['username'] == null){
                $this->error("姓名不能为空");
            }
            //验证密码
            if($data['password'] == null){
                $this->error("请输入正确的密码");
            }
            //检查pid是否为空
            if($data['pid'] == null){
                $this->error("代理ID错误,请重新输入!");
            }
            $user = M('Users')->where(array('code'=>$data['pid']))->find();
            if(!$user){
                $this->error("代理ID错误,请重新输入!");
            }

            $data['level'] = $user['level']+1;
            //分配随机ID
            $sql = "SELECT t1.*
FROM `__UUID__` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `__UUID__`)-(SELECT MIN(id) FROM `__UUID__`))+(SELECT MIN(id) FROM `__UUID__`)) AS id) AS t2
WHERE t1.id >= t2.id AND t1.state <> 1 
ORDER BY t1.id LIMIT 1;";
            $code = M('Uuid')->query($sql);
            //var_dump($code);exit;
            $id = $code[0]['id'];
            //分配的id修改状态，表示已经分配，不可再次分配
            M('Uuid')->where("id=$id")->setField('state',1);
            $data['code'] = $code[0]['uuid'];
            //不全相关其它注册参数
            $data['password'] = md5($data['password']);
            $data['register_time']=time();
            $data['last_login_time']=time();
            $data['last_login_ip']=get_client_ip();

            $uid=M('Users')->add($data);
            //返回id分配代理权限
            $map['uid'] = $uid;
            //访问权限全部是A级代理权限
            $map['group_id'] = 2;
            M('AuthGroupAccess')->add($map);

            if($uid){
               /* $_SESSION['user']=array(
                    'id'=>$uid,
                    'username'=>$data['username'],
                );*/
                $this->success('注册成功',U('Home/Index/index'));
            }else{
                $this->error('注册失败');
            }
        }else{
            $this->display();
        }

    }



    /**
     * 退出
     */
    public function logout(){
        session('user',null);
        $this->success('退出成功、房卡交易系统',U('Home/Index/index'));
    }



    /**
     * 用来做测试用
     */
    public function test(){
        p($_SESSION);
        die;
        echo C('SESSION_OPTIONS.expire',10);
        session('test','222');
    }


}

