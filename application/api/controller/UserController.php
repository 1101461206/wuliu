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
use app\api\model\CosModel as cos;
use app\api\model\FaceModel as face;
use app\api\model\HttpModel as http;
use app\api\model\PersonnelModel as per;


class UserController extends ApiController
{

    /**
     * grant_type 授权类型，此处只需填写 authorization_code
     * js_code    登录时获取的 code
     */
    public function indexAction()
    {
        $param = request()->post();

        switch ($param['type']){
            case "login":
                $url="https://api.weixin.qq.com/sns/jscode2session?appid=".config('wx_appid')."&secret=".config('wx_appsecret')."&js_code=".$param['code']."&grant_type=authorization_code";
                $http=new http();
                $info=$http->https($url);
                echo $info;
                break;
            default:
                echo "错误";
                break;
        }

    }


    /**
     * 查询人员 填写是否中断过
     */
    public function checknameAction(){
        $param=request()->post("openid");
       $check=Db::table('xiao_form')->where('openid',$param)->find();
       if(empty($check)){
           echo json_encode(array('num'=>0));
       }else{
           echo json_encode($check);
       }



    }

    /**
     * 添加人员
     */
    public function userAction(){
        $param = request()->post();
        switch($param['num']){
            case 1:
                $data=array(
                    'openid'=>$param['openid'],
                    'num'=>$param['num'],
                );
                $data['longitude']=$param['longitude'];
                $data['latitude']=$param['latitude'];
                $check=Db::table('xiao_form')->where('openid',$param['openid'])->find();
                if($check){
                    echo json_encode(0);
                }else{
                    $in = Db::name('xiao_form')->insertGetId($data);
//                    if($in){
//                        echo 1;
//                    }
                }
                break;
            case 2:
              //  echo 3;
             //  $data=['name'=>$param['name'],'mobile'=>(int)$param['mobile'],'num'=>$param['num']];
               $up=Db::table('xiao_form')
                  ->where('openid',$param['openid'])
                   ->data(['num'=>$param['num'],'name'=>$param['name'],'mobile'=>(int)$param['mobile']])
                  ->update();
               if($up>0){
                   echo 1;
               }else{
                   echo 0;
            }
                break;
            default:
                echo 0;
        }






    }


    public function ceshiAction(){

//        Log::write('12312x','error');
        $msg=array();
//            'model'=>'face',
//            'action'=>'',
//            'msg'=>array(
//                'openid'=>111,
//                "numam"=>"erer",
//            ),
//        );
  //     $msg=json_encode($msg);
//        //$this->Cmq('sendcmq',"ceshi",$msg);

        $data=array('personid');

       // $this->GetPersonGroupInfo();
     $this->Cmq("receive","ceshi",$msg);


    }

    /**
     * 用户上传图片
     */
    public function imgAction(){
           $openid=request()->post('openid');
           $submit=request()->post('submit');
           $type=request()->post('type');
           $cmq=$this->request->post('cmq');
           //上传到本地
           $file=new file();
           $local_info=$file->file();
           if(empty($local_info['error'])){
               $local_img=$local_info['mag']['img'];
               if(!empty($local_img)){
                   $check=Db::table('xiao_form')->where('openid',$openid)->find();
                   $check_img=Db::table('xiao_form_img')
                            ->where('f_id',$check['id'])
                            ->where('img_type',$type)
                            ->find();
                   if($check_img){
                       $in=Db::name('xiao_form_img')
                           ->where('id',$check_img['id'])
                           ->data(['img'=>$local_img,'img_oos'=>"",'img_type'=>$type])
                           ->update();
                   }else{
                       $data=['f_id'=>$check['id'],'img'=>$local_img,'img_type'=>$type];
                       $in=Db::name('xiao_form_img')->insert($data);
                   }

               }
           }else{
               if($type>2){
                   echo 1;

               }
	       trace('1','info');
	       trace($local_info,'info');
               trace($local_info['error']['mag'],'error');

           }

           if($submit){
                $msg=array(
                    'model'=>'form',
                    'msg'=>array(
                        'openid'=>$openid,
                    ),
                );
             
                    $send_info=$this->Cmq('sendcmq',"ceshi",$msg);
                    $send_info=json_decode($send_info,true);
                    if($send_info['code']>0){
                        trace($msg,'error');
                    }
                
                echo 1; 
		//  echo $send_info;
            }else{
                echo 1;
            }


    }

    /**
     * 发送消息队列
     */

    public function Cmq($action,$name,$msg){
        $info=$this->tx_cmq($action,$name,$msg);
        return $info;

    }

}
