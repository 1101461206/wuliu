<?php /*a:4:{s:50:"/www/wuliu/application/admin/view/order/index.html";i:1543282757;s:45:"/www/wuliu/application/admin/view/header.html";i:1550558382;s:43:"/www/wuliu/application/admin/view/tabs.html";i:1543284632;s:45:"/www/wuliu/application/admin/view/footer.html";i:1542700548;}*/ ?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>爱风尚管理系统</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/static/admin/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/static/admin/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/static/admin/css/amazeui.min.css"/>
    <link rel="stylesheet" href="/static/admin/css/admin.css">
    <script src="/static/admin/js/jquery.min.js"></script>
    <script src="/static/admin/js/app.js"></script>
    <script src="/static/admin/js/vue.js"></script>
</head>
<!--[if lte IE 9]><p class="browsehappy">升级你的浏览器吧！ <a href="http://se.360.cn/" target="_blank">升级浏览器</a>以获得更好的体验！</p><![endif]-->
</head>
<body>
<header class="am-topbar admin-header">
    <div class="am-topbar-brand"><img src="/static/admin/i/logo.png"></div>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav admin-header-list">
            <!--<li class="am-dropdown tognzhi" data-am-dropdown>-->
                <!--<button class="am-btn am-btn-primary am-dropdown-toggle am-btn-xs am-radius am-icon-bell-o" data-am-dropdown-toggle> 消息管理<span class="am-badge am-badge-danger am-round">6</span></button>-->
                <!--<ul class="am-dropdown-content">-->
                    <!--<li class="am-dropdown-header">所有消息都在这里</li>-->
                    <!--<li><a href="#">未激活会员 <span class="am-badge am-badge-danger am-round">556</span></a></li>-->
                    <!--<li><a href="#">未激活代理 <span class="am-badge am-badge-danger am-round">69</span></a></a></li>-->
                    <!--<li><a href="#">未处理汇款</a></li>-->
                    <!--<li><a href="#">未发放提现</a></li>-->
                    <!--<li><a href="#">未发货订单</a></li>-->
                    <!--<li><a href="#">低库存产品</a></li>-->
                    <!--<li><a href="#">信息反馈</a></li>-->
                <!--</ul>-->
            <!--</li>-->
            <li class="kuanjie">
                <a class="am-icon-home" href="<?php echo url('admin/index/index'); ?>">首页</a>
                <a href="#">会员管理</a>
                <a href="<?php echo url('admin/order/index'); ?>">订单管理</a>
                <a href="#">产品管理</a>
                <a href="#">个人中心</a>
                <a href="#">系统设置</a>
            </li>
            <li class="soso">
                <p>
                    <select data-am-selected="{btnWidth: 70, btnSize: 'sm', btnStyle: 'default'}">
                        <option value="b">全部</option>
                        <option value="o">产品</option>
                        <option value="o">会员</option>
                    </select>
                </p>

                <p class="ycfg"><input type="text" class="am-form-field am-input-sm" placeholder="圆角表单域" /></p>
                <p><button class="am-btn am-btn-xs am-btn-default am-xiao"><i class="am-icon-search"></i></button></p>
            </li>
            <li class="am-hide-sm-only" style="float: right;"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
        </ul>
    </div>
</header>
<div class=" admin-content">

    <div class="daohang">
        <ul>
            <!--<li><button type="button" class="am-btn am-btn-default am-radius am-btn-xs" href="<?php echo url('admin/index/index'); ?>"> 首页 </li>-->
            <!--<li><button type="button" class="am-btn am-btn-default am-radius am-btn-xs">帮助中心<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close="">×</a></button></li>-->
            <!--<li><button type="button" class="am-btn am-btn-default am-radius am-btn-xs">奖金管理<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close="">×</a></button></li>-->
            <!--<li><button type="button" class="am-btn am-btn-default am-radius am-btn-xs">产品管理<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close="">×</a></button></li>-->
        </ul>
    </div>
<div class="am-cf admin-main">

    <div class="nav-navicon admin-main admin-sidebar">


        <div class="sideMenu am-icon-dashboard" style="color:#aeb2b7; margin: 10px 0 0 0;"> 欢迎系统管理员：<?php echo htmlentities($admin_name); ?></div>
        <div class="sideMenu">
            <h3 class="am-icon-flag"><em></em> <a href="#">商品管理</a></h3>
            <ul>
                <li><a href="">商品列表</a></li>
                <li class="func" dataType='html' dataLink='msn.htm' iconImg='images/msn.gif'>添加新商品</li>
                <li>商品分类</li>
                <li>用户评论</li>
                <li>商品回收站</li>
                <li>库存管理 </li>
            </ul>
            <h3 class="am-icon-cart-plus"><em></em> <a href="#"> 订单管理</a></h3>
            <ul>
                <li><a href="<?php echo url('admin/order/list'); ?>">订单列表</a></li>
                <li>合并订单</li>
                <li>订单打印</li>
                <li>添加订单</li>
                <li>发货单列表</li>
                <li>换货单列表</li>
            </ul>
            <h3 class="am-icon-users"><em></em> <a href="#">会员管理</a></h3>
            <ul>
                <li><a href="<?php echo url('admin/user/index'); ?>">会员列表</a> </li>
                <li>未激活会员</li>
                <li>团队系谱图</li>
                <li>会员推荐图</li>
                <li>推荐列表</li>
            </ul>
            <h3 class="am-icon-volume-up"><em></em> <a href="#">信息通知</a></h3>
            <ul>
                <li>站内消息 /留言 </li>
                <li>短信</li>
                <li>邮件</li>
                <li>微信</li>
                <li>客服</li>
            </ul>
            <h3 class="am-icon-gears"><em></em> <a href="#">系统设置</a></h3>
            <ul>
                <li>数据备份</li>
                <li>邮件/短信管理</li>
                <li>上传/下载</li>
                <li>权限</li>
                <li>网站设置</li>
                <li>第三方支付</li>
                <li>提现 /转账 出入账汇率</li>
                <li>平台设置</li>
                <li>声音文件</li>
            </ul>
        </div>
        <!-- sideMenu End -->

        <script type="text/javascript">
            jQuery(".sideMenu").slide({
                titCell:"h3", //鼠标触发对象
                targetCell:"ul", //与titCell一一对应，第n个titCell控制第n个targetCell的显示隐藏
                effect:"slideDown", //targetCell下拉效果
                delayTime:300 , //效果时间
                triggerTime:150, //鼠标延迟触发时间（默认150）
                defaultPlay:true,//默认是否执行效果（默认true）
                returnDefault:true //鼠标从.sideMen移走后返回默认状态（默认false）
            });
        </script>


    </div>

<div class="admin-biaogelist">

    <div class="listbiaoti am-cf">
        <ul class="am-icon-flag on"> 订单列表</ul>

        <dl class="am-icon-home" style="float: right;">当前位置： 首页 > <a href="#">订单列表</a></dl>

        <dl>
            <button type="button" class="am-btn am-btn-danger am-round am-btn-xs am-icon-plus" >代下单</button>
        </dl>
        <!--这里打开的是新页面-->
    </div>

    <form class="am-form am-g">
        <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped am-table-hover">
            <thead>
            <tr class="am-success">
                <th class="table-type am-hide-sm-only" width="20%">商品名称</th>
                <th class="table-type am-hide-sm-only" width="8%">单价/数量</th>
                <th class="table-date am-hide-sm-only" width="6%">订单金额</th>
                <th class="table-date am-hide-sm-only" width="10%">下单人</th>
                <th class="table-date am-hide-sm-only" width="10%">收件人/收件电话</th>
                <th class="table-date am-hide-sm-only" width="10%">收件地址</th>
                <th class="table-date am-hide-sm-only" width="6%">支付方式</th>
                <th class="table-date am-hide-sm-only" width="6%">订单状态</th>
                <th class="table-type am-hide-sm-only" width="6%">备货状态</th>
                <th class="table-type am-hide-sm-only" width="10%">下单时间</th>
                <th width="6%" class="table-set">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
            <tr>
                <td colspan="11" >
                    <span class="am-fl am-padding-horizontal">订单编号：<?php echo htmlentities($row['order_sn']); ?></span>
                    <span class="am-fr am-padding-horizontal" >归属客服:<?php echo htmlentities($row['name']); ?></span></td>
            </tr>
            <?php foreach($row['goods_name'] as $key=>$vo): ?>
            <tr>
                <td  class="am-text-left am-text-middle"><?php echo htmlentities($vo['goods_name']); ?></td>
                <td class="am-text-center am-text-middle"><?php echo htmlentities($vo['shop_price']); ?><br><?php echo htmlentities($vo['standard_name']); ?><br>*<?php echo htmlentities($vo['goods_number']); ?></td>
                <?php if($key==0): ?>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-middle am-text-center"><?php echo htmlentities($row['goods_amount']); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle"><?php echo htmlentities($row['nick_name']); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle"><?php echo htmlentities($row['consignee']); ?><br><?php echo htmlentities($row['telephone']); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle"><?php echo htmlentities($row['province_name']); ?>-<?php echo htmlentities($row['city_name']); ?>-<?php echo htmlentities($row['address']); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle"><?php echo htmlentities($row['pay_name']); ?><br><?php echo htmlentities($row['pay_status']); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle"><?php echo htmlentities($row['order_status']); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle"><?php echo htmlentities($row['prepare_status']); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle"><?php echo htmlentities(date("Y-m-d",!is_numeric($row['add_time'])? strtotime($row['add_time']) : $row['add_time'])); ?><br><?php echo htmlentities(date("H:i:s",!is_numeric($row['add_time'])? strtotime($row['add_time']) : $row['add_time'])); ?></td>
                <td rowspan="<?php echo count($row['goods_name']) ?>" class="am-text-center am-text-middle">
                   <button type="button" class="am-btn am-btn-primary am-round am-btn-sm">详情</button>
                </td>
                <?php endif; ?>


                <!--<td>14</td>-->
                <!--<td><a href="#">Business management</a></td>-->
                <!--<td>3件 （消费455个积分）</td>-->
                <!--<td class="am-hide-sm-only">访问</td><td class="am-hide-sm-only">访问</td>-->
                <!--<td class="am-hide-sm-only">2014年9月4日 7:28:47</td>-->
                <!--<td>-->
                    <!--<div class="am-btn-toolbar">-->
                        <!--<div class="am-btn-group am-btn-group-xs">-->
                            <!--<button class="am-btn am-btn-default am-btn-xs am-text-success am-round"><span class="am-icon-search" title="查看订单详情"></span> </button>-->
                            <!--<button class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" data-am-modal="{target: '#my-popups'}" title="修改订单"><span class="am-icon-pencil-square-o"></span></button>-->
                            <!--<button class="am-btn am-btn-default am-btn-xs am-text-danger am-round" title="删除订单"><span class="am-icon-trash-o" ></span></button>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</td>-->
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="11"></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <?php echo $page; ?>
        <!--<ul class="am-pagination am-fr">-->
            <!--<li class="am-disabled"><a href="#">«</a></li>-->
            <!--<li class="am-active"><a href="#">1</a></li>-->
            <!--<li><a href="#">2</a></li>-->
            <!--<li><a href="#">3</a></li>-->
            <!--<li><a href="#">4</a></li>-->
            <!--<li><a href="#">5</a></li>-->
            <!--<li><a href="#">»</a></li>-->
        <!--</ul>-->
    </form>











</div>
<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/static/admin/js/polyfill/rem.min.js"></script>
<script src="/static/admin/js/polyfill/respond.min.js"></script>
<script src="/static/admin/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/static/admin/js/amazeui.min.js"></script>
<!--<![endif]-->



</body>
</html>
