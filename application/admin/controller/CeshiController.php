<?php

namespace app\admin\controller;

use app\api\model\ApiModel;
use think\Controller;
use app\api\model\ApiModel as api;
use think\Db;


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

    public function indexAction()
    {
        $ims_url = array('img_url' => "https://xiao-1256168726.cos.ap-chengdu.myqcloud.com/1.png");
        $api = new ApiModel();
        $info = $api->discern('GeneralBasicOCR', $ims_url);
        $data=array(
            'location'=>$info,
        );
        $in = Db::name('xiao_form_img')->insertGetId($data);
        echo "<pre>";
        var_dump($info, true);
        echo "<pre>";
    }
    //  return $this->fetch('order/index');
}

