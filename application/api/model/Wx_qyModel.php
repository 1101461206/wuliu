<?php

namespace app\api\model;

use tests\ThumbTest;
use think\facade\Log;
use think\Model;
use think\Db;

include_once ROOT_PATH . "/extend/wx/weworkapi/callback/WXBizMsgCrypt.php";


class Wx_qyModel extends ApiModel
{
    //验证URL
    function verify_url($msg_signature, $timestamp, $echostr, $nonce)
    {

        $wxcpt = new \WXBizMsgCrypt(config('wx_qy_token'), config('wx_qy_aeskey'), config('wx_qy_corpid'));
        $sEchoStr = "";
//        //-----------------------测试数据----------------------------------
//        $msg_signature="5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3";
//        $timestamp="1409659589";
//        $echostr="P9nAzCzyDtyTWESHep1vC5X9xho/qYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp+4RPcs8TgAE7OaBO+FZXvnaqQ==";
//        $nonce="263014780";
//        $wxcpt=new \WXBizMsgCrypt("QDG6eK","jWmYm7qr5nMoAUwZRjGtBxmz3KA1tkAj3ykkR6q2B2C","wx5823bf96d3bd56c7");
//        //----------------------------------------------------------------
        $errorcode = $wxcpt->VerifyURL($msg_signature, $timestamp, $nonce, $echostr, $sEchoStr);
        Log::write("验证信息" . $errorcode);
        if ($errorcode == 0) {
            echo $sEchoStr;
            exit;
        } else {
            Log::write("验证错误" . $errorcode);
        }
    }

    //处理推送消息xml

    function xml_decrypt($msg_signature, $timestamp, $nonce, $data)
    {
        $wxcpt = new \WXBizMsgCrypt(config('wx_qy_token'), config('wx_qy_aeskey'), config('wx_qy_corpid'));
        $xml_info = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($xml_info->ToUserName == config('wx_qy_corpid')) {
            $sMsg = "";
            $err_code = $wxcpt->DecryptMsg($msg_signature, $timestamp, $nonce, $data, $sMsg);
            Log::write('返回解密1：' . $sMsg, 'notice');
            $xmldata = simplexml_load_string($sMsg, 'SimpleXMLElement', LIBXML_NOCDATA);
            $xmljson = json_encode($xmldata);//将对象转换个JSON
            $xmlarray = json_decode($xmljson, true);//将json转换成数组
            Log::write("解码111：" . $xmldata, 'notice');
            // return  $xmlarray;


        }
    }

    //处理解密消息
    function processing_messages($data)
    {
        // $_W['euserid']=$data['euserid'];
    }


    //测试
    function ceshi(){
        $data="<xml><ToUserName><![CDATA[wwc9e12f4cc5c86bf5]]></ToUserName><FromUserName><![CDATA[sys]]></FromUserName><CreateTime>1593496954</CreateTime><MsgType><![CDATA[event]]></MsgType><Event><![CDATA[change_external_contact]]></Event><ChangeType><![CDATA[add_external_contact]]></ChangeType><UserID><![CDATA[ZhaoZiLong]]></UserID><ExternalUserID><![CDATA[wmk-T7DwAAiA_FKyeSAfcqqic_KNfLKA]]></ExternalUserID><WelcomeCode><![CDATA[2E-H1cuwevbSwlBZxiiwgP4wmX33w0Kv9-l1CH4T_as]]></WelcomeCode></xml>";
        $xml_info = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $xmljson = json_encode($xml_info);//将对象转换个JSON
        $xmlarray = json_decode($xmljson, true);//将json转换成数组
        var_dump($xmlarray);
    }



}
