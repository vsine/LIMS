$(function(){
    // 鍒濆鍖朿heckbox浜嬩欢
    $('#rememberMe').iCheck({
        checkboxClass: 'icheckbox_square-green',
        increaseArea: '20%' // optional
    });

    // 鍔ㄦ€佺爜鐧婚檰鐨勬椂鍊欐牎楠屽拰杩涜鍊掕鏃�
    $("#casDynamicLoginForm").find("#getDynamicCode").click(function () {
        var username = $("#casDynamicLoginForm").find("#username");

        if (!checkRequired(username, "dynamicNameError")) {
            username.focus();
            return;
        }
        var isSliderCaptcha=$("#isSliderCaptcha").val();
        //鍖哄垎婊戝潡楠岃瘉杩樻槸闅忔満鍥惧舰鐮侀獙璇�
        if(!isSliderCaptcha) {
            var captchaResponse = $("#casDynamicLoginForm").find("#dynamicCodeCaptchaResponse");
            if (!checkRequired(captchaResponse, "dyCpatchaError")) {
                captchaResponse.focus();
                return;
            }
            var _t = username.val();
            try{
                _t = encryptAES(_t,$("#casDynamicLoginForm").find("#dynamicPwdEncryptSalt").val());
            }catch(e){
            }
            sendDynamicCodeByPhone(_t, "dynamicCodeType", captchaResponse.val());
        }else{
            //鍦ㄥ彂閫佹墜鏈洪獙璇佺爜涔嬪墠 鍑虹幇婊戝潡
            $("#captcha-id").show();
            //鐢熸垚婊戝潡楠岃瘉鐮�
            createSliderCaptcha();
            //鍖哄垎鍔ㄦ€佺爜璺熻处鍙峰瘑鐮佺櫥褰�
            $("#sliderCaptchaDynamicCode").val("isDynamicCode");
        }
    });

    // 缁戝畾閫夐」鍗＄殑鐐瑰嚮浜嬩欢
//    $(".auth_tab_content_item[tabid=02]").hide();
    $(".auth_tab_links li").bind("click",function(){
        selectLi($(this));
    });

});

function loadFresh(){
    if(window != window.top){
        // 澶勭悊鍚屽煙鍚嶄笅鐨剅eload
        try{
            top.location.reload(true);
        }catch(ignoreErr){
        }
        // 澶勭悊璺ㄥ煙鎯呭喌涓嬬殑reload
        try{
            window.top.postMessage({type:"loginReload"},'*');
        }catch(ignoreErr){
        }
    }
}

function selectLi(obj){
    $(obj).siblings().removeClass("selected");
    $(obj).addClass("selected");
    var tabid = $(obj).attr("tabid");

    $(".auth_tab_content_item").hide();
    $(".auth_tab_content_item[tabid="+tabid+"]").show();
}