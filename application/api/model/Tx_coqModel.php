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
        foreach ($img as $k => $v) {
            switch ($v['img_type']) {
                //处理个人照
                case 1:
                    /**是否上传到oss*/
                    if ($v['img'] && empty($v['img_oos'])) {
                        $coss = $this->CosImg($v['img']);
                        if ($coss['code'] == 1) {
                            $up = Db::table('xiao_form_img')
                                ->where('id', $v['id'])
                                ->data(['img_oos' => $coss['mag']['img_url']])
                                ->update();
                            if ($up) {
                                $face = $this->DetectFace($coss['mag']['img_url'], 1, 1);
                                $oss_url = $coss['mag']['img_url'];
                            }
                        }else{
                            trace($coss.'+++'.$v['id'],'error');
                        }
                    } else {
                        $face = $this->DetectFace($v['img_oos'], 1, 1);
                        $oss_url = $v['img_oos'];
                    }
                    /**获取上传图片人脸信息*/
                    if ($face) {
                        $face = json_decode($face, true);
                        $face_info = ['age' => $face['mag']['age'], 'sex' => $face['mag']['sex'], 'img_text' => $face['mag']['text']];
                        $face_up = Db::table('xiao_form')
                            ->where('id', $v['f_id'])
                            ->data($face_info)
                            ->update();
                    }


                    /**去人员库搜索*/
                    $searchFaces=$this->SearchFaces($oss_url,'form');
                    if($searchFaces['code']>0){
                        $searchFaces_info=['matching'=>1,'personid'=>$searchFaces['mag']['PersonId'],'faceid'=>$searchFaces['mag']['FaceId'],'score'=>$searchFaces['mag']['Score']];
                        $searchFaces_up=Db::table('xiao_form_img')
                            ->where('id',$v['id'])
                            ->data($searchFaces_info)
                            ->update();
                    }else{
                        /**上传至人员库，创建人员*/
                        $person = array(
                            'img' => $oss_url,
                            'GroupId' => 'form',
                            'PersonName' => $v['name'],
                            'PersonId' => time(),
                            'Gender'=>$face['mag']['sex'],
                            'info'=>$v['id'],
                        );
                        $person_info=$this->CreatePerson($person);

                    }
                    break;
                default:
                    break;
            }


        }
    }



}