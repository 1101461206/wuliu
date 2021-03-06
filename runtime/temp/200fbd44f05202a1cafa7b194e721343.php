<?php /*a:1:{s:50:"/www/wuliu/application/admin/view/login/index.html";i:1557381472;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/static/admin/login/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/static/admin/login/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" type="text/css" href="/static/admin/login/css/amazeui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/login/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/login/css/app.css">
    <script src="/static/admin/login/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/admin/lib/sweetalert/sweetalert.css" />
</head>
<body data-type="login">
<script src="/static/admin/login/js/theme.js"></script>
<div class="am-g tpl-g">
    <!-- 风格切换 -->
    <div class="tpl-login" id="login">
        <div class="tpl-login-content">
            <div class="tpl-login-logo">
                <p><b>爱风尚分销系统<b></p>
                <p><span>iFun management system</span></p>
            </div>
            <form class="am-form tpl-form-line-form">
                <div class="am-form-group">
                    <input type="text" v-model="form.name"class="tpl-form-input" id="name" name="name" placeholder="请输入用户名">
                </div>
                <div class="am-form-group ">
                    <input type="password" v-model="form.pwd" class="tpl-form-input" id="pwd" name="pwd" placeholder="请输入密码">
                </div>
                <div class="am-form-group am-fl am-u-sm-5 am-padding-0" >
                    <input type="text" v-model="form.verification" class="tpl-form-input " id="verification" name="verification" placeholder="验证码">

                </div>
                <div class="am-form-group am-fr">
                  <img onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random()" src="<?php echo captcha_src(); ?>" />
                </div>
                <div class="am-cf"></div>
                <div class="am-form-group tpl-login-remember-me">
                    <input id="remember-me" type="checkbox">
                    <label for="remember-me">
                        记住密码
                    </label>
                </div>
                <div class="am-form-group">
                    <button type="button" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn" @click="login">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/static/admin/login/js/amazeui.min.js"></script>
<script src="/static/admin/login/js/app.js"></script>
<script src="/static/admin/js/vue.js"></script>
<script src="/static/admin/lib/sweetalert/sweetalert.min.js"></script>


<script>
    new Vue({
        el:'#login',
        data:{
            form:{
                name: '',
                pwd: '',
                verification: '',
            }
        },

        methods:{
            login: function () {
                if(!this.form.name){
                    swal({title:"用户名不能为空", type:"warning",showConfirmButton:false,allowOutsideClick:true,timer:2000});
                    return;
                }
                if(!this.form.pwd){
                    swal({title:"密码不能为空", type:"warning",showConfirmButton:false,allowOutsideClick:true,timer:2000});
                    return;
                }
                if(!this.form.verification){
                    swal({title:"验证码不能为空", type:"warning",showConfirmButton:false,allowOutsideClick:true,timer:2000});
                    return;
                }

                $.ajax({
                    type: 'POST',
                    data: this.form,
                    url: "<?php echo url('portal/Loginadmin/login'); ?>",
                    dataType: "json",
                    success:function(data){
                        switch (data.code) {
                            case 503:
                                swal({
                                    title: data.msg,
                                    type: "warning",
                                    showConfirmButton: false,
                                    allowOutsideClick: true,
                                    timer: 2000
                                });
                                break;
                            case 502:
                                swal({
                                    title: data.msg,
                                    type: "warning",
                                    showConfirmButton: false,
                                    allowOutsideClick: true,
                                    timer: 2000
                                });
                                break;
                            case 501:
                                swal({
                                    title: data.msg,
                                    type: "warning",
                                    showConfirmButton: false,
                                    allowOutsideClick: true,
                                    timer: 2000
                                });
                                break;
                            default:
                                window.location.href = "<?php echo url('admin/index/index'); ?>";
                                break;
                        }
                        },
                     error: function (e) {
                            console.log("错误提示： " + e.status + " " + e.statusText);
                        }


                });
            },
        }
    })

</script>

</body>

</html>