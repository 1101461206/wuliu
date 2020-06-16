<?php

namespace app\api\model;

use tests\ThumbTest;
use think\facade\Log;
use think\Model;
use think\Db;
include_once ROOT_PATH."/extend/wx/weworkapi/callback/WXBizMsgCrypt.php";


class Wx_qyModel extends ApiModel
{
    function verify_url($msg_signature,$timestamp,$echostr,$nonce){

        $wxcpt=new \WXBizMsgCrypt(config('wx_qy_token'),config('wx_qy_aeskey'),config('wx_qy_corpid'));
        $sEchoStr="";
//        //-----------------------测试数据----------------------------------
//        $msg_signature="5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3";
//        $timestamp="1409659589";
//        $echostr="P9nAzCzyDtyTWESHep1vC5X9xho/qYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp+4RPcs8TgAE7OaBO+FZXvnaqQ==";
//        $nonce="263014780";
//        $wxcpt=new \WXBizMsgCrypt("QDG6eK","jWmYm7qr5nMoAUwZRjGtBxmz3KA1tkAj3ykkR6q2B2C","wx5823bf96d3bd56c7");
//        //----------------------------------------------------------------
        $errorcode=$wxcpt->VerifyURL($msg_signature,$timestamp,$nonce,$echostr,$sEchoStr);
        Log::write("验证信息".$errorcode);
        if($errorcode == 0){
            echo $sEchoStr;
            exit;
        }else{
            Log::write("验证错误".$errorcode);
        }
    }


    function xml_decrypt($msg_signature,$timestamp,$nonce,$data){
	    Log::write('22224444444444');
        $wxcpt=new \WXBizMsgCrypt(config('wx_qy_token'),config('wx_qy_aeskey'),config('wx_qy_corpid'));
        $sMsg="";
        $err_code = $wxcpt->DecryptMsg($msg_signature, $timestamp, $nonce, $data, $sMsg);
	$xml_data=simplexml_load_string($sMsg, 'SimpleXMLElement', LIBXML_NOCDATA);	
	 Log::write("解密：".$xml_data->ToUserName);
    }






}
