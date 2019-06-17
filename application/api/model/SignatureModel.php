<?php
namespace app\api\model;

use think\Model;


class SignatureModel extends Model{
    /**
     * 腾讯api秘钥生成新版
     * https://cloud.tencent.com/document/api/867/32775
     */

    public function tx_make($data,$key,$url){
        ksort($data);
        $uu = array();
        foreach ($data as $k => $v) {
            $uu[] = $k . "=" . $v;
        }
        $par = implode("&", $uu);
        $url .= $par;
        $signStr = base64_encode(hash_hmac('sha1', $url,$key, true));
        $signStr=urlencode($signStr);
        $info=array(
            'par'=>$par,
            'signStr'=>$signStr,
        );
        return $info;
    }

    /**
     * 秘钥随机数
     */
    public function random($num){
        $a=array('1','2','3','4','5','6','7','8','9','0');
        $number='';
        for($i=0;$i<$num;$i++){
            $number.=array_rand($a,1);
        }
        return $number;
    }

    /**
     * 手写体智能识别 生成秘钥(旧版 OCR)
     * https://cloud.tencent.com/document/product/866/17734#php-.E7.AD.BE.E5.90.8D.E7.A4.BA.E4.BE.8B
     */

    public function handwriting_stcstr($appid,$id,$key){
        $bucket = "";
        $expired=time()+60;
        $current=time();
        $rdm=$this->random(4);
        $srcStr = 'a='.$appid.'&b='.$bucket.'&k='.$id.'&e='.$expired.'&t='.$current.'&r='.$rdm.'&f=';
        $signStr = base64_encode(hash_hmac('SHA1', $srcStr, $key , true).$srcStr);
        return $signStr;
    }

}