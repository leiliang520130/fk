<?php
/**
 * Created by PhpStorm.
 * User: joy
 * Date: 2017/9/15
 * Time: 9:55
 */
namespace Admin\Controller;
use Common\Controller\AdminBaseController;


class ManageController extends AdminBaseController
{

    public function admin_lst() {
        $lst = M('admin')->alias('a')
            ->field('a.*,c.title')
            ->join('LEFT JOIN cos_auth_group_access b on a.id=b.uid')
            ->join('LEFT JOIN cos_auth_group c on b.group_id=c.id')
            ->order('a.id asc')
            ->select();

        $this->assign("lst", $lst);
        $this->display();
    }


    //显示代理申请审核
    public function index(){


        $phone = I('phone', '');
        $username = I('username', '');
        $status=I('status','');

        //2、筛选
        $where = ' 1=1 AND a.id<>88';

        if($phone)  $where.=" AND a.phone = {$phone}";

        if($username) $where .= " AND a.username LIKE '%{$username}%'";

        if($status) $where .= " AND a.status = {$status}";

        //$data = get_page_data(M('Users'),$where,'register_time desc',10);
        //echo M('Info')->getLastSql();
        //子查询查询推荐人姓名
        //$subQuery = M('users')->field('username')->table('__USERS__')->buildSql();

        $model = M('Users');
        $count = $model
            ->alias('a')
            ->where($where)
            ->count();
        $page=new_page($count,10);
        // 获取分页数据
        $list=$model
            ->alias('a')
            ->field('a.*,b.username uname')
            ->where($where)
            ->order('register_time desc')
            ->join('LEFT JOIN __USERS__ b on a.pid=b.code')
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //var_dump($list);exit;
        $data=array(
            'data'=>$list,
            'page'=>$page->show()
        );


        $this->assign($data);
        $this->display();

    }
    //用户审核
    public function audit(){
        $id = I('id');
        $type=I('type',2);
        if(M('Users')->where(array('id'=>$id))->save(array('status'=>$type))!==false){
            die(json_encode(array('code'=>0)));
        }else{
            die(json_encode(array('code'=>-1)));
        };

    }

}