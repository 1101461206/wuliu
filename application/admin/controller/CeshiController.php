<?php
namespace app\admin\controller;
use app\api\model\ApiModel;
use think\Controller;
use app\api\model\ApiModel as api;


class CeshiController extends Controller
{
   // protected $merchant_id;
//    public function initialize()
//    {
//        $userinfo=Session::get('admin_info');
//        if(empty($userinfo)){
//            $this->redirect('admin/login/index');
//        }
//
//        $this->assign('admin_name',$userinfo['user_name']);
//    }

    public function indexAction(){
        $ims_url=array('img_url'=>"https://xiao-1256168726.cos.ap-chengdu.myqcloud.com/1.png");var_dump($ims_url);
        $info=ApiModel::discern('handwriting',$ims_url);
        var_dump($info);
      //  return $this->fetch('order/index');
    }
}
