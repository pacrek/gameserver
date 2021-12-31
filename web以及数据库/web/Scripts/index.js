/**
last time : 2015119
@author <linjie1@kingsoft.com>
**/
var phone = '';
var Main = (function() {
    var init = function() {
            getCode('.tel_num', '.get_code');
            takeOrder('.tel_num', '.code_num', '.submit');
            btnListener();
        },

        btnListener = function() {
            $('#needlogin .needlogin').click(function() {
                $('.order_step_2').hide();
                $('.order_step_1').hide();
                $('.get_vcode img').attr('src', 'http://xpass.xoyo.com/app/captcha?t=' + Math.random());
                $('.order_step_3').fadeIn();
            });

            $('.order_step_3 .needlogin').click(function() {
                var user_account = $('.account').val();
                var user_pass = $('.password').val();
                var user_code = $('.vcode').val();
                if (user_account != '' && user_pass != '' && user_code != '') {
                    login(user_account, user_pass, user_code);
                } else {
                    alert('请检查您的通行证账号或密码是否正确。');
                    $('.get_vcode img').attr('src', 'http://xpass.xoyo.com/app/captcha?t=' + Math.random());
                }
            });

            $('.get_vcode').click(function() {
                $('.get_vcode img').attr('src', 'http://xpass.xoyo.com/app/captcha?t=' + Math.random());
            });

        },
        // 登录
        login = function(acc, pass, vcode) {
            $.ajax({
                type: 'get',
                url: 'http://xpass.xoyo.com/app/api/passport/login/',
                dataType: 'jsonp',
                data: {
                    'user': acc,
                    'pass': pass,
                    'vcode': vcode
                },
                success: function(data) {
                    // console.log(data.status);
                    if (data.status > 0) {
                        addOrder();
                    } else {
                        alert("登录失败，请检查您的通行证账号或密码是否正确。");
                        $('.get_vcode img').attr('src', 'http://xpass.xoyo.com/app/captcha?t=' + Math.random());
                    }
                },
                error: function() {
                    // console.log('error');
                }
            })
        },
        // 预约号完了后
        addOrder = function() {
            // console.debug(window.phone);
            $.ajax({
                type: 'get',
                url: 'http://app.jxyd.xoyo.com/app/jxmobile1_order201511/add_order_failure_log',
                dataType: 'jsonp',
                data: {
                    'phone_number': window.phone,
                    'system_type': getVersions().system_type,
                    'system_version': getVersions().system_version,
                },
                success: function(data) {
                    // console.log(data.status);
                    if (data.status > 0) {
                        $('.order_step_1').hide();
                        $('.order_step_3').hide();
                        $('.wechat').show();
                        $('.succ').hide();
                        $('.failed').hide();
                        $('#needlogin').hide();
                        $('#justwait').show();
                        $('.order_step_2').fadeIn();
                    } else {
                        alert(data.tips);
                        $('.order_step_1').hide();
                        $('#needlogin').hide();
                        $('.succ').hide();
                        $('#justwait').hide();
                        $('#errtips').text(data.tips);
                        $('.order_step_2').fadeIn();
                    }
                },
                error: function() {
                    // console.log('error');
                }
            })
        },
        // 获取验证码
        getCode = function(input, link) {
            var num;
            var reg = new RegExp("^1[0-9]{10}$");
            $(link).tap(function() {
                num = $(input).val();
                window.phone = num;
                // console.log(window.phone);
                if (reg.test(num)) {
                    $.ajax({
                        type: 'get',
                        url: 'http://app.jxyd.xoyo.com/app/jxmobile1_order201511/send_phone_verify_code',
                        data: 'phone_number=' + num,
                        dataType: 'jsonp',
                        success: function(data) {
                            // console.log(data.status);
                            if (data.status < 0) {
                                $(input).val('');
                                $(input).focus();
                                if (data.status == -12) {
                                    alert(data.tips);
                                } else {
                                    $(input).attr('placeholder', data.tips);

                                }
                            } else {
                                alert('已发送验证码');
                            }
                        },
                        error: function() {
                            // console.log('error');
                        }
                    })
                } else {
                    $(input).val('');
                    $(input).attr('placeholder', '请输入正确的手机号码');
                    $(input).focus();
                }
            })
        },
        // 预约
        takeOrder = function(input1, input2, link) {
            var code, num;
            var reg = new RegExp("^1[0-9]{10}$");
            var system_type = getVersions().system_type;
            var system_version = getVersions().system_version;
            // console.log(system_type,system_version);
            $(link).tap(function() {
                num = $(input1).val();
                code = $(input2).val();
                if (reg.test(num)) {
                    if (code != '') {
                        $.ajax({
                            type: 'get',
                            url: 'http://app.jxyd.xoyo.com/app/jxmobile1_order201511/order',
                            data: 'phone_number=' + num + '&verify_code=' + code + '&system_type=' + system_type + '&system_version=' + system_version,
                            dataType: 'jsonp',
                            success: function(data) {
                                // console.log(data.status);
                                if (data.status < 0) {
                                    $(input2).val('');
                                    $(input2).attr('placeholder', data.tips);
                                    $(input2).focus();
                                    if (data.status === -20401) {
                                        $('.order_step_1').hide();
                                        $('.succ').hide();
                                        $('#justwait').hide();
                                        $('.failed').hide();
                                        $('.order_step_2').fadeIn();
                                    }
                                } else {
                                    var code2 = data.tips.code;
                                    $('.succ_code').text(code2);
                                    $('.order_step_1').hide();
                                    $('.failed').hide();
                                    $('.order_step_2').fadeIn();
                                }
                            },
                            error: function() {
                                // console.log('error');
                            }
                        })

                    } else {
                        $(input2).attr('placeholder', '请输入预约号');
                        $(input2).focus();
                    }
                } else {
                    $(input1).val('');
                    $(input1).attr('placeholder', '请输入正确的手机号');
                    $(input1).focus();
                }
            })
        },
        getVersions = function() {
            var u = navigator.userAgent,
                app = navigator.appVersion;
            if (u.indexOf('iPhone OS') > -1) {
                var a = u.indexOf('iPhone OS');
                var b = u.indexOf('like Mac');
                var v = u.substring(a + 10, b);
                return {
                    'system_type': 'ios',
                    'system_version': v
                }
            }
            if (u.indexOf('Android') > -1 || u.indexOf('Linux') > -1) {
                var a = u.indexOf('Android');
                var b = u.indexOf(';', a + 1);
                var v = u.substring(a + 8, b);
                return {
                    'system_type': 'Android',
                    'system_version': v
                }
            }
            if (u.indexOf('iPad') > -1) {
                var a = u.indexOf('CPU OS');
                var b = u.indexOf('like Mac');
                var v = u.substring(a + 7, b);
                return {
                    'system_type': 'iPad',
                    'system_version': v
                }
            }
            if (u.indexOf('Windows Phone') > -1) {
                return {
                    'system_type': 'winphone',
                    'system_version': ''
                };
            }
            return {
                'system_type': '',
                'system_version': ''
            };
        },
        replaceAddress = function(link) {
            var u = navigator.userAgent,
                app = navigator.appVersion,
                isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                isWC = u.indexOf('MicroMessenger') > -1;
            var android_link = 'http://p.xoyo.com/jxqy/jxqy_v1.0.apk';
            if (isAndroid && !isWC) {
                $(link).attr('href', android_link);
            }
            $(link).tap(function() {
                if (isiOS) {
                    alert('本次测试仅针对安卓机型，iOS用户敬请期待');
                } else if (isWC) {
                    $('.weixin_tip').fadeIn();
                }
            })
        };
    return {
        init: init,
        replaceAddress: replaceAddress
    }
})();