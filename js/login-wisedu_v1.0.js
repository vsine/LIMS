// 杩欎釜鏄璁″埌鐧婚檰鎿嶄綔鐨勭粺涓€js
var t;

(function ($) {
    $(document).ready(function () {

        // 缁戝畾鎹㈤獙璇佺爜鐨勭偣鍑讳簨浠�
        $("#casLoginForm").find("#changeCaptcha").bind("click", function () {
            $("#casLoginForm").find("#captchaImg").attr("src", "captcha.html?ts=" + new Date().getMilliseconds());
        });

        $("#casLoginForm").find("#captchaImg").bind("click", function () {
            $("#casLoginForm").find("#captchaImg").attr("src", "captcha.html?ts=" + new Date().getMilliseconds());
        });

        //鍔ㄦ€佺爜鐧诲綍
        $("#casDynamicLoginForm").find("#dynamicCodeChangeCaptcha").bind("click", function () {
            $("#casDynamicLoginForm").find("#dynamicCodeCaptchaImg").attr("src", "captcha.html?ts=" + new Date().getMilliseconds());
        });

        $("#casDynamicLoginForm").find("#dynamicCodeCaptchaImg").bind("click", function () {
            $("#casDynamicLoginForm").find("#dynamicCodeCaptchaImg").attr("src", "captcha.html?ts=" + new Date().getMilliseconds());
        });

        // 缁戝畾鎻愪氦浜嬩欢
        /* $("#casLoginForm").find("#login-button").bind("click",function(){
         $("#casLoginForm").submit();
         });*/
        $("#casDynamicLoginForm").find("#login-button").bind("click", function () {
            $("#casDynamicLoginForm").submit();
        });

        // 缁戝畾甯愬彿鐧诲綍椤甸潰 鐢ㄦ埛鍚嶈緭鍏ユ淇敼浜嬩欢锛屽垽鏂槸鍚﹀凡缁忓～鍐�
        var casLogin_username = $("#casLoginForm").find("#username");
        casLogin_username.bind("change", function () {
            checkRequired($(this), "usernameError");
        });
        // 缁戝畾甯愬彿鐧诲綍椤甸潰 瀵嗙爜杈撳叆妗嗕慨鏀逛簨浠讹紝鍒ゆ柇鏄惁宸茬粡濉啓
        var casLogin_password = $("#casLoginForm").find("#password");
        casLogin_password.bind("change", function () {
            checkRequired($(this), "passwordError");
        });
        //婊戝潡楠岃瘉鐮侊細鐢ㄦ埛鍚嶅瘑鐮佷笉闇€瑕佺鐒︿簨浠讹紝鐐瑰嚮鐧诲綍妫€楠屽嵆鍙�
        var isSliderCaptcha=$("#isSliderCaptcha").val();
        if(!isSliderCaptcha){
            casLogin_username.bind("blur", function () {
                getCaptcha();
            });
            casLogin_password.bind("blur", function () {
                getCaptcha();
            });
        }

        // 缁戝畾鍔ㄦ€佺爜鐧诲綍椤甸潰 鐢ㄦ埛鍚嶈緭鍏ユ淇敼浜嬩欢锛屽垽鏂槸鍚﹀凡缁忓～鍐�
        $("#casDynamicLoginForm").find("#username").bind("change", function () {
            checkRequired($(this), "dynamicNameError");
        });

        // 缁戝畾鍔ㄦ€佺爜鐧诲綍椤甸潰 瀵嗙爜杈撳叆妗嗕慨鏀逛簨浠讹紝鍒ゆ柇鏄惁宸茬粡濉啓
        $("#casDynamicLoginForm").find("#dynamicCode").bind("change", function () {
            checkRequired($(this), "dynamicCodeError");
        });

        // 鍏冪礌鑱氱劍
        if ($("#username").val() != "") {
            $("#password").focus();
        } else {
            $("#username").focus();
        }

        //婊戝潡楠岃瘉鐮侊細杩欓噷鏄殢鏈洪獙璇佺爜
        if(!isSliderCaptcha) {
            // 甯愬彿鐧婚檰鎻愪氦banding浜嬩欢
            var casLoginForm = $("#casLoginForm");
            casLoginForm.submit(doLogin);
            function doLogin() {
                var username = casLoginForm.find("#username");
                var password = casLoginForm.find("#password");
                if (!checkRequired(username, "usernameError")) {
                    username.focus();
                    return false;
                }

                if (!checkRequired(password, "passwordError")) {
                    password.focus();
                    return false;
                }

                var captchaResponse = casLoginForm.find("#captchaResponse");
                if (!checkRequired(captchaResponse, "cpatchaError")) {
                    captchaResponse.focus();
                    return false;
                }

                _etd2(password.val(), casLoginForm.find("#pwdDefaultEncryptSalt").val());
            }

            // 鍔ㄦ€佺爜鐧婚檰鎻愪氦banding浜嬩欢
            var casDynamicLoginForm = $("#casDynamicLoginForm");
            casDynamicLoginForm.submit(doDynamicLogin);

            function doDynamicLogin() {
                var username = casDynamicLoginForm.find("#username");
                var dynamicCode = casDynamicLoginForm.find("#dynamicCode");

                if (!checkRequired(username, "dynamicNameError")) {
                    username.focus();
                    return false;
                }

                if (!checkRequired(dynamicCode, "dynamicCodeError")) {
                    dynamicCode.focus();
                    return false;
                }
            }
        }

        $(".auth_tab_links li").bind("click", function () {
            var qrLoginLi = $(this).hasClass("qrLogin");
            if (qrLoginLi) {
                getQrCode();
                //杞鐩戝惉椤甸潰
                countDown();
            } else {
                try {
                    clearTimeout(qr_time);
                } catch (err) {
                }

            }
        });
    });
})(jQuery);

function _etd(_p0) {try{var _p2 = encryptAES(_p0,pwdDefaultEncryptSalt);$("#casLoginForm").find("#passwordEncrypt").val(_p2);}catch(e){$("#casLoginForm").find("#passwordEncrypt").val(_p0);}}function _etd2(_p0,_p1) {try{var _p2 = encryptAES(_p0,_p1);$("#casLoginForm").find("#passwordEncrypt").val(_p2);}catch(e){$("#casLoginForm").find("#passwordEncrypt").val(_p0);}}
//1銆佹粦鍧楋細鍔ㄦ€佺爜
function submitDynamicForm(e){
    var casDynamicLoginForm = $("#casDynamicLoginForm");

    var username = casDynamicLoginForm.find("#username");
    var dynamicCode = casDynamicLoginForm.find("#dynamicCode");

    if (!checkRequired(username, "dynamicNameError")) {
        username.focus();
        //闃绘琛ㄥ崟button鎻愪氦
        e.preventDefault();
        return false;
    }

    if (!checkRequired(dynamicCode, "dynamicCodeError")) {
        dynamicCode.focus();
        //闃绘琛ㄥ崟button鎻愪氦
        e.preventDefault();
        return false;
    }
}
//2銆佹粦鍧楋細甯愬彿鐧婚檰琛ㄥ崟
function submitLoginForm(e) {
    var casLoginForm = $("#casLoginForm");
    var username = casLoginForm.find("#username");
    var password = casLoginForm.find("#password");
    //闃绘琛ㄥ崟button鎻愪氦
    e.preventDefault();

    if (!checkRequired(username, "usernameError")) {
        username.focus();
        return false;
    }

    if (!checkRequired(password, "passwordError")) {
        password.focus();
        return false;
    }
    _etd2(password.val(), casLoginForm.find("#pwdDefaultEncryptSalt").val());


    var isSliderCaptcha=$("#isSliderCaptcha").val();
    reValidateDeal(isSliderCaptcha);

}
function reValidateDeal(isSliderCaptcha) {
    var username = $.trim($("#casLoginForm").find("#username").val());
    if (username != "") {
        /*$.ajax("needCaptcha.html", {
            data: {username: username, pwdEncrypt2: "pwdEncryptSalt"},
            cache: false,
            dataType: "text",
            success: function (data) {
                if (data.indexOf("::::") > -1) {
                    var pwdEncryptArr = data.split("::::");
                    try {
                        pwdDefaultEncryptSalt = pwdEncryptArr[1];
                    } catch (e) {
                    }
                }
                if (data.indexOf("true") > -1) {
                    //濡傛灉鏄粦鍧楅獙璇佺爜
                    if (isSliderCaptcha) {
                        $("#captcha-id").show();
                        //鐢熸垚婊戝潡楠岃瘉鐮�
                        createSliderCaptcha();
                        //鍖哄垎鍔ㄦ€佺爜璺熻处鍙峰瘑鐮佺櫥褰�
                        $("#sliderCaptchaDynamicCode").val("");
                    }
                } else {
                    $("#captcha-id").empty();
                    //鐧诲綍涓嶉渶瑕佹粦鍧楅獙璇佺爜锛岀洿鎺ョ櫥褰�
                    var casLoginForm = $("#casLoginForm");
                    casLoginForm.submit();
                }
            }
        });*/
    }
}

// 缁熶竴鏍￠獙蹇呭～鍜屽睍绀洪敊璇俊鎭殑鏂规硶
function checkRequired(obj, msgId) {
    if (obj.length == 0) {
        return true;
    }

    if (obj.val() == "") {
        $("#" + msgId).show();
        return false;
    } else {
        $("#" + msgId).hide();
        return true;
    }
}

function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}

function getCaptcha() {
    var username = $.trim($("#casLoginForm").find("#username").val());
//    if ( username!= "" && $("#casLoginForm").find("#captchaResponse").length == 0) {


    if (username != "") {
        /*  $.ajax("needCaptcha.html", {
             data: {username: username, pwdEncrypt2: "pwdEncryptSalt"},
             cache: false,
             dataType: "text",
             success: function (data) {
                 if (data.indexOf("::::") > -1) {
                     var pwdEncryptArr = data.split("::::");
                     try {
                         pwdDefaultEncryptSalt = pwdEncryptArr[1];
                     } catch (e) {
                     }
                 }
                 if (data.indexOf("true") > -1) {
                     // 濡傛灉宸茬粡瀛樺湪楠岃瘉鐮侊紝閭ｄ箞灏变笉鍔�
                     if ($("#casLoginForm").find("#captchaResponse").length != 0) {
                         return;
                     }
                     var casCaptcha = $("#cpatchaDiv");
                     casCaptcha.empty();
                     casCaptcha.html($("#hidenCaptchaDiv").html());
                     $("#casLoginForm").find("#changeCaptcha").bind("click", function () {
                         $("#casLoginForm").find("#captchaImg").attr("src", "captcha.html?ts=" + new Date().getMilliseconds());
                     });
                     $("#casLoginForm").find("#captchaImg").bind("click", function () {
                         $("#casLoginForm").find("#captchaImg").attr("src", "captcha.html?ts=" + new Date().getMilliseconds());
                     });
                     casCaptcha.fadeIn("slow");
                 } else {
                     // 濡傛灉涓嶉渶瑕侀獙璇佺爜锛屽苟涓旈獙璇佺爜宸茬粡鍑虹幇锛岄偅涔堟竻绌�
                     if ($("#casLoginForm").find("#captchaResponse").length != 0) {
                         var casCaptcha = $("#cpatchaDiv");
                         casCaptcha.empty();
                     }
                 }
             }
         });*/
    }
}


/**
 聽* 鍊掕鏃跺嚱鏁�
 聽*
 聽*/
var buttonDefaultValue;//璁板綍榛樿鎸夐挳鍊�
function countDownButton(obj, second) {
    if (second == 120) {
        buttonDefaultValue = obj.value;
    }
    // 濡傛灉绉掓暟杩樻槸澶т簬0锛屽垯琛ㄧず鍊掕鏃惰繕娌＄粨鏉�
    if (second >= 0) {
        // 鎸夐挳缃负涓嶅彲鐐瑰嚮鐘舵€�
        obj.disabled = true;
        // 鎸夐挳閲岀殑鍐呭鍛堢幇鍊掕鏃剁姸鎬�
        obj.value = second + "s";
        // 鏃堕棿鍑忎竴
        second--;
        // 涓€绉掑悗閲嶅鎵ц
        setTimeout(function () {
            countDownButton(obj, second);
        }, 1000);
        // 鍚﹀垯锛屾寜閽噸缃负鍒濆鐘舵€�
    } else {
        // 鎸夐挳缃湭鍙偣鍑荤姸鎬�
        obj.disabled = false;
        // 鎸夐挳閲岀殑鍐呭鎭㈠鍒濆鐘舵€�
        obj.value = buttonDefaultValue;
    }
}

//鍙戦€侀獙璇佺爜.
function sendDynamicCodeByPhone(username, authCodeTypeName, captchaVal) {
    $.ajax({
        type: "POST",
        url: "getDynamicCode.do",
        dataType: "json",
        data: {userName: username, authCodeTypeName: authCodeTypeName, captchaResponse: captchaVal},
        success: function (data) {
            var res = data.res;
            var returnMessage = data.returnMessage;
            var mobile = data.mobile;
            if (res == "success") {
                $("#sendCodeWarnMessage").text(returnMessage + mobile);
                countDownButton(document.getElementById("getDynamicCode"), 120);
            } else if (res == "wechat_success") {
                $("#sendCodeWarnMessage").text(returnMessage);
                countDownButton(document.getElementById("getWChatQYDynamicCode"), 120);
            } else if (res == "cpdaily_success") {
                $("#sendCodeWarnMessage").text(returnMessage);
                countDownButton(document.getElementById("getCpdailyDynamicCode"), 120);
            } else {
                $("#sendCodeWarnMessage").text(returnMessage);
                $("#casDynamicLoginForm").find("#username").focus();
                $("#casDynamicLoginForm").find("#dynamicCodeCaptchaImg").attr("src", "captcha.html?ts=" + new Date().getMilliseconds());
            }
        }
    });
}

//浜岀淮鐮佺櫥褰�
/*function ajaxGetQRCode() {
 $.ajax({
 type: "POST",
 url: "getQRUid.do",
 dataType: "json",
 success: function (data) {
 var uuid = data.qrUid;
 var qrCodeImage = $("#qrCodeImage");
 if (qrCodeImage != "" && qrCodeImage != null && qrCodeImage != 'undefined') {
 qrCodeImage.attr("src", "getUrlQRCode?uuid=" + uuid);
 $(".auth_tab_content_item[tabid=03]").find("#casLoginForm").find("#uuid").val(uuid);
 checkQRCodeStatus(uuid);

 }
 }
 });
 }*/


/*function checkQRCodeStatus(uuid) {
 $("#appCodeRefresh").hide();
 $("#appCodeLoginLoad").hide();
 t = setInterval(function () {
 $.ajax({
 type: "GET",
 url: "qrCodeStatus.do",
 dataType: "json",
 data: {uuid: uuid},
 success: function (data) {
 var codeStatusType = data.codeStatus;
 var uid = data.uid;
 switch (codeStatusType) {
 case 401:
 break;
 case 404:
 $("#appCodeRefresh").show();
 $("#appCodeRefresh").bind("click", function () {
 ajaxGetQRCode();
 });
 clearInterval();
 break;
 case 200:
 $("#appCodeLoginLoad").show();
 $(".auth_tab_content_item[tabid=03]").find("#casLoginForm").submit();
 break;
 default :
 alert("鏈嶅姟鍣ㄧ淮鎶や腑锛岃绋嶅悗鍐嶈瘯");
 break;
 }
 }
 });
 }, 5000);
 }*/

function clearInterval() {
    clearTimeout(t);
}

//cs瀹㈡埛绔泦鎴�-rtx

function rtxLogin() {
    try {
        var objKernalRoot = RTXAX.GetObject("KernalRoot");
        var objRtcData = objKernalRoot.Sign;
        var strAccount = objKernalRoot.Account;
        var strSgin = objRtcData.GetString("Sign");
        if (strAccount != "" && strAccount.length > 0 && strSgin != "" && strSgin.length > 0) {
            alert("娆㈣繋浣跨敤rtx鐧婚檰锛�" + strAccount);
            csLogin(strAccount, strSgin);
        }
    } catch (e) {
        // alert(e);
    }
}

function csLogin(userId, csSignKey) {
    $.ajax({
        type: "POST",
        url: "rtxCombinedUserCheck.do",
        dataType: "json",
        data: {userId: userId},
        success: function (data) {
            var res = data.res;
            if (res == 1) {
                var rtxFrm = $(".auth_tab_content_item[tabid=04]").find("#rtxLoginForm");
                rtxFrm.find("#csUserId").val(userId);
                rtxFrm.find("#csSignKey").val(csSignKey);
                ///alert("娆㈣繋浣跨敤rtx鐧婚檰锛�" + strAccount);
                rtxFrm.submit();

            } else {

            }
        }
    });
}