<?php

namespace app\api\model;

use think\Model;
use think\Db;


class Tx_coqModel extends ApiModel
{

    function tx_form($data)
    {
        $openid = $data['msg']['openid'];
        $sql = "select i.*,t.name from xiao_form_img i,(select id,name from xiao_form where openid='$openid') t where i.f_id=t.id";
        $img = Db::query($sql);
        $img_type1="";
        $img_type2="";
        $img_type3="";
        foreach ($img as $k => $v) {
            /**是否上传到oss*/
            if ($v['img'] && empty($v['img_oos'])) {
                if($v['img_type']==3){
                    $image = \think\Image::open(IMG_PATH.$v['img']);
                    $size=$image->size();
                    var_dump($size);
                   $a= $image->thumb(150,150)->save(THUMB_PATH.$v['img']);
                    var_dump($a);
                    exit;

                }
                $coss = $this->CosImg($v['img']);
                if ($coss['code'] == 1) {
                    $up = Db::table('xiao_form_img')
                        ->where('id', $v['id'])
                        ->data(['img_oos' => $coss['mag']['img_url']])
                        ->update();
                    $oss_url=$coss['mag']['img_url'];
                }else{
                    trace($coss.'+++'.$v['id'],'error');
                    continue;
                }
            }else{
                $oss_url = $v['img_oos'];
            }
            switch ($v['img_type']) {
                //处理个人照
                case 1:
//                    $img_type1=$oss_url;
//                    $img_info=array();
//                    //判断照片里的人数
//                    $analuze=$this->AnalyzeFace($oss_url,"","");
//                    if($analuze['code']==1){
//                        $img_info['location']=$analuze['mag'];
//                        if($analuze['num']==1){
//                            /**去人员库搜索*/
//                            $searchFaces=$this->SearchFaces($oss_url,'form');
//                            if($searchFaces['code']>0){
//                                $img_info['personid']=$searchFaces['mag']['PersonId'];
//                                $img_info['faceid']=$searchFaces['mag']['FaceId'];
//                                $img_info['score']=$searchFaces['mag']['Score'];
//                            }else{
//                                /**获取上传图片人脸信息*/
//                                $face = $this->DetectFace( $oss_url, 1, 1);
//                                if ($face) {
//                                    $face = json_decode($face, true);
//                                    $face_info = ['age' => $face['mag']['age'], 'sex' => $face['mag']['sex'], 'img_text' => $face['mag']['text']];
//                                    $face_up = Db::table('xiao_form')
//                                        ->where('id', $v['f_id'])
//                                        ->data($face_info)
//                                        ->update();
//                                }
//                                /**上传至人员库，创建人员*/
//                                $person = array(
//                                    'img' => $oss_url,
//                                    'GroupId' => 'form',
//                                    'PersonName' => $v['name'],
//                                    'PersonId' => time(),
//                                    'Gender'=>$face['mag']['sex'],
//                                    'info'=>$v['id'],
//                                );
//                                $person_info=$this->CreatePerson($person);
//                                $img_info=['status'=>2];
//                            }
//                        }else{
//                            $img_info['status']=1;
//                            $img_info['status_info']="照片中人数大于1人";
//                        }
//
//
//                    }else{
//                        $img_info=['status'=>1,'status_info'=>$analuze['mag']];
//                    }
//                    $searchFaces_up=Db::table('xiao_form_img')
//                        ->where('id',$v['id'])
//                        ->data($img_info)
//                        ->update();
                    break;

                case 2:
//                    $img_info=array();
//                    $img_type2=$oss_url;
//                    $analuze=$this->AnalyzeFace($oss_url,"","");
//                    if($analuze['code']==1){
//                        if($analuze['num']>2){
//                            $compare=$this->CompareFace($img_type1,$img_type2);
//                            if($compare['code']==1){
//                                if($compare['score']<80){
//                                    $img_info=['status'=>2,'score'=>$compare['score']];
//                                }else{
//                                    $img_info=['status'=>1,'score'=>$compare['score']];
//                                }
//                            }else{
//                                $img_info=['status'=>1,'status_info'=>$compare['mag']];
//                            }
//
//                        }else{
//                            $img_info=['status'=>1,'status_info'=>"人数不符合"];
//                        }
//                    }else{
//                        $img_info=['status'=>1,'status_info'=>$analuze['mag']];
//                    }
//                    $searchFaces_up=Db::table('xiao_form_img')
//                        ->where('id',$v['id'])
//                        ->data($img_info)
//                        ->update();
                    break;
                case 3:
                    echo $oss_url;
                    $img_type3=$oss_url;
                    $genera=$this->discern('GeneralBasicOCR',array('img_url'=>$oss_url));


                    break;

                default:
                    break;
            }


        }
    }



}