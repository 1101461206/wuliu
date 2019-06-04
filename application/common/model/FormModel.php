<?php
namespace app\common\model;

use think\Db;
use think\Model;

class FormModel extends Model{
    /**填表用户列表*/
    function huiyuan_list(){
        $list=Db::name('xiao_form')
                ->order('id','desc')
                ->paginate(20);




        return $list;



    }

}