<?php

namespace app\api\controller;

use app\common\model\UseradminModel as useradmin;
use think\App;
use think\Controller;
use think\Request;
use think\facade\Config;
use think\facade\Session;
use app\api\model\HttpModel as http;
use app\api\model\FaceModel as face;
use app\api\model\PersonnelModel as per;
use app\api\model\CmqModel as cmq;


class ApiController extends Controller
{
  /**
   * cul 连接
   */
  public function https($url){
      $http=new http();
      $info=$http->https($url);
      return $info;

  }

  /**
   * 人脸识别
   */

  public function face($action,$url,$type,$num){
      $face=new face();
      $info=$face->$action($url,$type,$num);
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
     * 调用消息队列
     */
    public function tx_cmq($action,$name,$msg){
        $cmq=new cmq();
        $info=$cmq->$action($name,$msg);
        return $info;
    }

    /**
     * 获取人员归属信息
     */
    public function GetPersonGroupInfo($data){
        $info=$this->per('GetPersonGroupInfo',$data);
        return $info;

    }



}
