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
use extend\wx\weworkapi\callnack\WXNizMsgCrypt as wxapi;


class QywxController extends ApiController
{

    public function indexAction()
    {
        Log::write(request()->get('msg_signature')."-----1234321");
	Log::write('fdfdfd');
    }







}
