<?php
namespace app\common\model;

use think\Db;
use think\Model;
use api\model\ApiModel;

class FormModel extends Model{
    /**填表用户列表*/
    function huiyuan_list(){
        $list=Db::name('xiao_form')
                ->order('id','desc')
                ->paginate(20);
        return $list;
    }

    function info($param){

        $info=Db::table('xiao_form')
            ->alias('f')
            ->where('f.id',$param['id'])
            ->find();
        return $info;
    }

    function info_img($param){
        $info=Db::table('xiao_form_img')
            ->field('*')
            ->where('f_id',$param['id'])
            ->select();
        if($info[0]['status']==1){
//            $api=new \app\api\model\ApiModel();
//            $api->GetPersonGroupInfo(array('personid'=>$info[0]['personid']));
            $face=Db::table('xiao_form_img')
                ->where('faceid',$info[0]['faceid_resemble'])
                ->find();
            $info[0]['xiangsi']=$face['img_oos'];
        }

        return $info;

    }
}