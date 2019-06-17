<?php
namespace app\admin\controller;
use think\App;
use think\helper\Time;
use app\common\model\FormModel as form;

class FormController extends AdminController
{

    function __construct()
    {
       parent::__construct();
       $this->form=model('Form');
    }


    /**
     * @return mixed
     * @throws \think\exception\DbException
     * 表单
     */


    public function indexAction()
    {
        $user=new user();
        $list=$user::name('user u')
            ->join('user us','us.user_id=u.parent_id')
            ->join('admin ad','ad.admin_id=u.kfuser')
            ->field('u.user_id,u.head_image_url,u.telephone,u.nick_name,u.unionid,u.user_role,us.nick_name as p_name,u.openid,u.unionid,u.create_time,u.is_subscribe,ad.name as kfuser')
            ->order('u.user_id','desc')
            ->paginate('20');
        $count=$list->total();
        $page=$list->render();
        $this->assign('page',$page);
        $this->assign('list',$list);
        return $this->fetch('user/index');
    }


    /**
     * 会员列表
     */

    public function huiyuan_listAction(){

        $list=$this->form->huiyuan_list();
        $page=$list->render();
        $this->assign('page',$page);
        $this->assign('list',$list);
        return $this->fetch();
    }



    public function infoAction(){
        $param=request()->param();
        $info=$this->form->info($param);
        $info_img=$this->form->info_img($param);
        $this->assign('info',$info);
        $this->assign('info_img',$info_img);

        return $this->fetch();
    }



}
