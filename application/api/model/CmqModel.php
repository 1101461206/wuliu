<?php
namespace app\api\model;

use think\Exception;
use think\Model;
use think\helper;
use app\api\model\SignatureModel as sig;
use think\facade\Log;



class CmqModel extends ApiModel {

    function __construct()
    {

        parent::__construct();
    }

//发送消息
    function sendcmq($name,$msg){
        $time=time();
        $num=$this->signature('random',array('num'=>4));
        $msg['type']="tx";
        $msg=json_encode($msg);
        $data['data']=array(
            'queueName'=>$name,
            'msgBody'=>$msg,
            'Action'=>"SendMessage",
            'Region'=>"cd",
            'Timestamp'=>$time,
            'Nonce'=>$num,
            'SecretId'=>$this->ssecretId,
        );
        $data['url']="GETcmq-queue-cd.api.qcloud.com/v2/index.php?";
        //$data['url']="GETcmq-queue-cd.api.tencentyun.com/v2/index.php?";
        $data['key']=$this->secretKey;
        $Signature=$this->signature("tx_make",$data);
       // $url="http://cmq-queue-cd.api.tencentyun.com/v2/index.php?".$Signature['par']."&Signature=".$Signature['signStr'];
        $url="https://cmq-queue-cd.api.qcloud.com/v2/index.php?".$Signature['par']."&Signature=".$Signature['signStr'];
        $info=$this->https($url);
        $info=json_decode($info,true);
        $info['msg']=$msg;
        //错误机制
        if($info['code']>0){
           // var_dump($info);
          // Log::write($info,'info');
            trace("dfd",'error');
            return 0;
        }else{
            return 1;
        }
    }

// 读取消息
    function receive($name,$msg){

        $sleep = 1000000 * rand(1, 3);
        $i=1;
        while ($i<2){
            usleep($sleep);//延迟执行
            $time=time();
            $num=$this->signature('random',array('num'=>4));
            $data['data']=array(
                'queueName'=>$name,
                'Action'=>"ReceiveMessage",
                'Region'=>"cd",
                'Timestamp'=>$time,
                'Nonce'=>$num,
                'SecretId'=>$this->ssecretId,
            );
            $data['url']="GETcmq-queue-cd.api.qcloud.com/v2/index.php?";
           // $data['url']="GETcmq-queue-cd.api.tencentyun.com/v2/index.php?";
            $data['key']=$this->secretKey;
            $Signature=$this->signature("tx_make",$data);
            $url="https://cmq-queue-cd.api.qcloud.com/v2/index.php?".$Signature['par']."&Signature=".$Signature['signStr'];
            //$url="http://cmq-queue-cd.api.tencentyun.com/v2/index.php?".$Signature['par']."&Signature=".$Signature['signStr'];
            $info=$this->https($url);
            $info=json_decode($info,true);
//            echo "<pre>";
//            var_dump($info);
//            echo "<pre>";
 //           echo date('Y-m-d H:i:s',$info['nextVisibleTime']);
            if($info['code']>0){
                $sleep=2000000;
                trace($info,'error');
            }else{
                $sleep=20000;
            }

           //处理消息
            try{
                if(!empty($info['msgBody'])){
                   $this->action($info);
                    $this->del('ceshi',$info['receiptHandle']);

                }
            }catch (\Exception $e){
                trace($e,'error');

            }
          // $i++;

        }

    }

    function del($name,$id){
        $time=time();
        $num=$this->signature('random',array('num'=>4));
        $data['data']=array(
            'queueName'=>$name,
            'Action'=>"DeleteMessage",
            'Region'=>"cd",
            'Timestamp'=>$time,
            'Nonce'=>$num,
            'SecretId'=>$this->ssecretId,
            'receiptHandle'=>$id,
        );

       // $data['url']="GETcmq-queue-cd.api.tencentyun.com/v2/index.php?";
        $data['url']="GETcmq-queue-cd.api.qcloud.com/v2/index.php?";
        $data['key']=$this->secretKey;
//        echo "<br>";
//        echo "<pre>";
//        var_dump($data);
//        echo "<pre>";

        $Signature=$this->signature("tx_make",$data);
//        echo "<br>";
//        echo "<pre>";
//        var_dump($Signature);
//        echo "<pre>";
        $url="https://cmq-queue-cd.api.qcloud.com/v2/index.php?".$Signature['par']."&Signature=".$Signature['signStr'];
        //$url="http://cmq-queue-cd.api.tencentyun.com/v2/index.php?".$Signature['par']."&Signature=".$Signature['signStr'];
//       echo $url;
        $info=$this->https($url);
//        echo "<br>";
//        echo "<pre>";
//        var_dump($info);
//        echo "<pre>";


    }



}
