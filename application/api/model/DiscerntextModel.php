<?php
namespace app\api\model;

use think\Model;
/**
 * 智能识图
 */


class DiscerntextModel extends ApiModel {

    function __construct()
    {

        parent::__construct();
    }


    /**
     * 通用印刷体识别
     * https://cloud.tencent.com/document/api/866/33526
     */
    public function GeneralBasicOCR($data){
        $rand_num=$this->signature('random',array('num'=>4));
        $time=time();
        $data=array(
            'Action'=>'GeneralAccurateOCR',
            'Version'=>'2018-11-19',
            'Region'=>"ap-guangzhou",
            'ImageUrl'=>$data['img_url'],
            'Timestamp'=>$time,
            'Nonce'=>$rand_num,
            'SecretId'=>$this->ssecretId,
        );
        $s_url = "GETocr.tencentcloudapi.com/?";
        $signature=$this->signature("tx_make",array('data'=>$data,'key'=>$this->secretKey,'url'=>$s_url));
        $url="https://ocr.tencentcloudapi.com/?".$signature['par']."&Signature=".$signature['signStr'];
        $info=$this->https($url);
        $info1=json_decode($info,true);
//        echo "<pre>";
//        var_dump($info1);
//        echo "<pre>";
//        exit;
        if(empty($info1['Response']['Error'])){

        }else{
            $data=array(
                'code'=>2,
                'mag'=>$info
            );
        }
        return $info;


    }


    /**
     * 手写体识别
     * https://cloud.tencent.com/document/product/866/17596#.E9.94.99.E8.AF.AF.E7.A0.81
     */
    public function handwriting($data){
        $srcsig=$this->signature('handwriting_stcstr','');
        $headers=[];
        $headers[]= 'Host:recognition.image.myqcloud.com';
        $headers[]='content-type:application/json';
        $headers[]='authorization:'.$srcsig;

        $data1=[];
        $data1['appid']=$this->appid;
        $data1['url']=$data['img_url'];
        $data1=json_encode($data1);
        $url="https://recognition.image.myqcloud.com/ocr/handwriting";
        $info=$this->https_tou($url,$data1,$headers);
        $info=json_decode($info,true);
        $text="";
        if($info['data']['items']){
            foreach ($info['data']['items'] as $k=>$v){
                $text.=$v['itemstring'];
            };
            $mag=array(
                'code'=>1,
                'mag'=>$text,
            );
        }else{
            $mag=array(
                'code'=>2,
            );
        }
        return $mag;


    }




}