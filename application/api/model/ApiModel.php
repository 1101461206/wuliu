<?php

namespace app\api\model;
use app\api\model\HttpModel as http;
use think\Model;
use app\api\model\SignatureModel as sig;
use app\api\model\FaceModel as face;
use app\api\model\Tx_coqModel as txcomq;
use app\api\model\CosModel as cos;
use app\api\model\PersonnelModel as per;
use app\api\model\DiscerntextModel as dis;






class ApiModel extends Model
{
    protected $ssecretId="AKIDLyJtIVYHpVxstfmfsb8JfgZLunQGjPgn";
    protected $secretKey="2ZpuBJGKX0JrHcR21mVlW3xlRSI4ezHL";
    protected $region="ap-chengdu";
    protected $appid="1256168726";


    /**
     * @https  对外https连接
     */
    public function https($url)
    {
        $http=new http();
        $info=$http->https($url);
        return $info;
    }

    public function https_tou($url,$data,$headers)
    {
        $http=new http();
        $info=$http->https_tou($url,$data,$headers);
        return $info;
    }


    /**
     * @random  生成随机数
     * @tx_make 生成秘钥
     */
    public function signature($action,$data){
        $sig=new sig();
        switch($action){
            case "random":
                $info=$sig->random($data['num']);
                return $info;
                break;
            case "tx_make":
                $info=$sig->tx_make($data['data'],$data['key'],$data['url']);
                return $info;
                break;
            case "handwriting_stcstr":
                $info=$sig->handwriting_stcstr($this->appid,$this->ssecretId,$this->secretKey);
                return $info;
                break;
            default:
                break;
        }
    }


    /**
     * 调用消息队列
     */
    public function tx_cmq($action,$name,$msg){
        $cmq=new cmq();
        $info=$cmq->$action($name,$msg);
        return $info;
    }



    /**
     * 消息队列解读完，调用消息队列中得指定的消息
     */
    public function action($msg){
        $info=json_decode($msg['msgBody'],true);
        $model=$info['model'];
        switch ($model){
            case "form":
                $txcomq=new txcomq();
                $info=$txcomq->tx_form($info);
                return $info;
                break;
            default:
                break;
        }

    }




    /**
     * 上传到oss
     */
    public function CosImg($local_img,$path){
        $local_cos=new cos();
        $cos_img=$local_cos->cos($local_img,$path);
        return $cos_img;

    }


    /**
     * 人脸识别方法调用
     */

    public function face($action,$url,$type="",$num=""){
        $face=new face();
        $info=$face->$action($url,$type,$num);
        return $info;

    }

    /**
     * 人脸五官定位
     */
    public function AnalyzeFace($cos_img){
        $detectface=$this->face("AnalyzeFace",$cos_img);
        return $detectface;
    }


    /**
     * 人脸分析
     */
    public function DetectFace($cos_img,$type,$num){
        $detectface=$this->face("DetectFace",$cos_img,$type,$num);
        return $detectface;
    }


    /**
     * 人脸搜索
     */
    public function SearchFaces($img_url,$type,$num=""){
        $info=$this->face("SearchFaces",$img_url,$type,$num="");
        return $info;
    }

    /**
     * 人脸对比
     */
     public function CompareFace($imga,$imgb){
         $img_url=['imga'=>$imga,'imgb'=>$imgb];
         $info=$this->face("CompareFace",$img_url,"","");
         return $info;
     }


    /**
     * 调用人员库
     */

    public function per($action,$data){
        $per=new per();
        $info=$per->$action($data);
        return $info;

    }

    /**
     * 获取人员库列表
     */
    public function perAction(){
        $info=$this->per('pool');
        return $info;

    }

    /**
     * 创建人员
     */
    public function CreatePerson($data){
        $info=$this->per('CreatePerson',$data);
        return $info;

    }

    /**
     * 增加新照片到原有人员组中，增加人脸
     */
    public function CreateFace($data){
        $info=$this->per('CreateFace',$data);
        return $info;

    }

    /**
     * 获取人员归属信息
     */
    public function GetPersonGroupInfo($data){
        $info=$this->per('GetPersonGroupInfo',$data);
        return $info;

    }

    /**
     * 智能识图
     */
    public function discern($action,$data){
        $dis=new dis();
        $info=$dis->$action($data);
        return $info;

    }





}