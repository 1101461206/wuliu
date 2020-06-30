<?php

namespace app\api\controller;

use app\api\model\FileModel as file;
use think\App;
use think\Controller;
use think\Request;
use think\facade\Config;
use think\facade\Log;
use think\helper;
use think\Db;
use app\api\model\Wx_qyModel as wx;

//use WXBizMsgCrypt as wxapi;


class QywxController extends ApiController
{

    public function indexAction()
    {
        $msg_signature=request()->get('msg_signature');
        $timestamp=request()->get('timestamp');
        $echostr=request()->get('echostr');
        $nonce=request()->get('nonce');
        $wx=new wx();
        $wx->ceshi();
        exit;
	if(!empty($echostr)){
            $verifyurl=$wx->verify_url($msg_signature,$timestamp,$echostr,$nonce);
        }
	if(request()->isPost()){
            $sReqData = file_get_contents("php://input");
            $data=$wx->xml_decrypt($msg_signature,$timestamp,$nonce,$sReqData);
           // Log::write('返回解密22：'.$data, 'notice');
           // if($data['code']==0){
           //     echo 200;
                //$info=$wx->processing_messages($data);
           // }

        }







    }







}
