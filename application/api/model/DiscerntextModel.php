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
        var_dump($info1);
        exit;
        if(empty($info1['Response']['Error'])){

        }else{
            $data=array(
                'code'=>2,
                'mag'=>$info
            );
        }
        return $info;


    }




}