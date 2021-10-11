var b64map = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
var b64pad = "=";

var BI_RM = "0123456789abcdefghijklmnopqrstuvwxyz";

//整型转字符串
function int2char(n) {
    return BI_RM.charAt(n);
}

//十六进制转Base64字符串
function hex2b64(h) {
    var i;
    var c;
    var ret = "";
    for (i = 0; i + 3 <= h.length; i += 3) {
        c = parseInt(h.substring(i, i + 3), 16);
        ret += b64map.charAt(c >> 6) + b64map.charAt(c & 63);
    }
    if (i + 1 == h.length) {
        c = parseInt(h.substring(i, i + 1), 16);
        ret += b64map.charAt(c << 2);
    }
    else if (i + 2 == h.length) {
        c = parseInt(h.substring(i, i + 2), 16);
        ret += b64map.charAt(c >> 2) + b64map.charAt((c & 3) << 4);
    }
    while ((ret.length & 3) > 0) {
        ret += b64pad;
    }
    return ret;
}

//Base64字符串转十六进制
function b64tohex(s) {
    var ret = "";
    var i;
    var k = 0; // b64 state, 0-3
    var slop = 0;
    for (i = 0; i < s.length; ++i) {
        if (s.charAt(i) == b64pad) {
            break;
        }
        var v = b64map.indexOf(s.charAt(i));
        if (v < 0) {
            continue;
        }
        if (k == 0) {
            ret += int2char(v >> 2);
            slop = v & 3;
            k = 1;
        }
        else if (k == 1) {
            ret += int2char((slop << 2) | (v >> 4));
            slop = v & 0xf;
            k = 2;
        }
        else if (k == 2) {
            ret += int2char(slop);
            ret += int2char(v >> 2);
            slop = v & 3;
            k = 3;
        }
        else {
            ret += int2char((slop << 2) | (v >> 4));
            ret += int2char(v & 0xf);
            k = 0;
        }
    }
    if (k == 1) {
        ret += int2char(slop << 2);
    }
    return ret;
}

//十六进制转字节
function hexToBytes(hex) {
    for (var bytes = [], c = 0; c < hex.length; c += 2)
        bytes.push(parseInt(hex.substr(c, 2), 16));
    return bytes;
}

//字节转十六进制
function bytesToHex(bytes) {
    for (var hex = [], i = 0; i < bytes.length; i++) {
        hex.push((bytes[i] >>> 4).toString(16));
        hex.push((bytes[i] & 0xF).toString(16));
    }
    return hex.join("");
}

String.prototype.replaceAllStr=function(f,e){
    var reg=new RegExp(f,"g");
    return this.replace(reg,e);
}

function urlsafeEncode(e) {
    return e.replaceAllStr("\\+","-").replaceAllStr("/","_").replaceAllStr("=","");
}

function urlsafeDecode(e) {
    e =  e.replaceAllStr("-","+").replaceAllStr("_","/");
    var mob = e.length%4;
    if(mob>0){
        e += "====".substr(mob);
    }
    return e;
}


//长字符串加密
JSEncrypt.prototype.encryptLong = function (string) {
    var k = this.getKey();
    //var MAX_ENCRYPT_BLOCK = (((k.n.bitLength() + 7) >> 3) - 11);
    var MAX_ENCRYPT_BLOCK = 117;

    try {
        var lt = "";
        var ct = "";
        //RSA每次加密117bytes，需要辅助方法判断字符串截取位置
        //1.获取字符串截取点
        var bytes = new Array();
        bytes.push(0);
        var byteNo = 0;
        var len, c;
        len = string.length;

        var temp = 0;
        for (var i = 0; i < len; i++) {
            c = string.charCodeAt(i);
            if (c >= 0x010000 && c <= 0x10FFFF) {
                byteNo += 4;
            } else if (c >= 0x000800 && c <= 0x00FFFF) {
                byteNo += 3;
            } else if (c >= 0x000080 && c <= 0x0007FF) {
                byteNo += 2;
            } else {
                byteNo += 1;
            }
            if ((byteNo % MAX_ENCRYPT_BLOCK) >= 114 || (byteNo % MAX_ENCRYPT_BLOCK) == 0) {
                if (byteNo - temp >= 114) {
                    bytes.push(i);
                    temp = byteNo;
                }
            }
        }

        //2.截取字符串并分段加密
        if (bytes.length > 1) {
            for (var i = 0; i < bytes.length - 1; i++) {
                var str;
                if (i == 0) {
                    str = string.substring(0, bytes[i + 1] + 1);
                } else {
                    str = string.substring(bytes[i] + 1, bytes[i + 1] + 1);
                }
                var t1 = k.encrypt(str);
                ct += t1;
            }
            ;
            if (bytes[bytes.length - 1] != string.length - 1) {
                var lastStr = string.substring(bytes[bytes.length - 1] + 1);
                ct += k.encrypt(lastStr);
            }
            return hex2b64(ct);
        }
        var t = k.encrypt(string);
        var y = hex2b64(t);
        return y;
    } catch (ex) {
        return false;
    }
};

//长字符串解密
JSEncrypt.prototype.decryptLong = function (string) {
    var k = this.getKey();
    // var MAX_DECRYPT_BLOCK = ((k.n.bitLength()+7)>>3);
    var MAX_DECRYPT_BLOCK = 128;
    try {
        var ct = "";
        var t1;
        var bufTmp;
        var hexTmp;
        var str = b64tohex(string);
        var buf = hexToBytes(str);
        var inputLen = buf.length;
        //开始长度
        var offSet = 0;
        //结束长度
        var endOffSet = MAX_DECRYPT_BLOCK;

        //分段加密
        while (inputLen - offSet > 0) {
            if (inputLen - offSet > MAX_DECRYPT_BLOCK) {
                bufTmp = buf.slice(offSet, endOffSet);
                hexTmp = bytesToHex(bufTmp);
                t1 = k.decrypt(hexTmp);
                ct += t1;
            } else {
                bufTmp = buf.slice(offSet, inputLen);
                hexTmp = bytesToHex(bufTmp);
                t1 = k.decrypt(hexTmp);
                ct += t1;
            }
            offSet += MAX_DECRYPT_BLOCK;
            endOffSet += MAX_DECRYPT_BLOCK;
        }
        return ct;
    } catch (ex) {
        return false;
    }
};


// Call this code when the page is done loading.
var publicKeyStr =  "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDGdiNW38TIiIpZ2nugSk0AgXNQ" +
    "u3GHMPkKMwvelMB2V2gRu4wdtnoq4m5Xy3noYERu8QCpkvp2fc7JlyPpqXs98g+w " +
    "563WA88JH++OS840eJmc6j3JR4Y/5jX/yvq9Ykl/PvGJGNvTBuNXPbj9pwuiUDqU" +
    "7gUQLXgGqssxxuxBswIDAQAB";



//var sourceStr = "abcd";
//公钥加密
//var encrypt = new JSEncrypt();
//encrypt.setPublicKey(publicKeyStr);
//var encrypted = encrypt.encryptLong(sourceStr);
//encrypted = urlsafeEncode(encrypted);

//私钥解密
//var decrypt = new JSEncrypt();
//decrypt.setPrivateKey(privateKeyStr);
//var uncrypted = decrypt.decryptLong(urlsafeDecode(encrypted));
//console.log("public encrypted: ",encrypted);
//console.log("private uncrypted: ",uncrypted);
//console.log("private uncrypted: ",decrypt.decryptLong(urlsafeDecode("aVUeE9BxldnoRm_iq5mh9whNw4BaxD8qf0xdufq2DsXrkOmMCywWeSFvJZ0rL96ZB2-Ixi5odrrWVC5HGgWzjVpczlZuJOAkNtZVuc6RIadtCpgc3d7LZI4mHdvcsRFSEerHdBbhlGKZnLmAl1cPhD9EvUZY0HshUPK80o51ibY")));
//console.log("private uncrypted: ",decrypt.decryptLong(urlsafeDecode("gkC5ZJWSve2jMx1A9BDD0Y9L-Zr1Tif50WMF6jmJvlBWZBIbnP_1FoesLinJLsQZf_4aMgPWNbmm_fkYOlTmxkepqQAeLTdhDcaJOCJkkDQdGAtr9CeaokCURZ2olFRFrpJG6tpenQ9615bBlg5snR0Dx48M8J_IhDUO5zCw4eY")));