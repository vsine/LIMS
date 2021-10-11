<?php
require "config.php";









$private_key = <<<KEY
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDGdiNW38TIiIpZ2nugSk0AgXNQu3GHMPkKMwvelMB2V2gRu4wd
tnoq4m5Xy3noYERu8QCpkvp2fc7JlyPpqXs98g+w563WA88JH++OS840eJmc6j3J
R4Y/5jX/yvq9Ykl/PvGJGNvTBuNXPbj9pwuiUDqU7gUQLXgGqssxxuxBswIDAQAB
AoGACRpWGJ/+6KvKnMB2ty1xRrqpTWSrmmXWpm8c9kKgaU0tCtMtZBeAlwL3yLMe
jlgMC4KmYyDIuDKhD4INNaR+cI4lls4B5bbvhxLj+yz4tRWqtkHoeDXlWL2mqyzz
KZ2DlYGMgy77rooCTFADwHpWflEjO2y58K7ZpYYmBGvZOKECQQD6JyxYTzuskTWr
Ca+mGnWroxL93nvun5NJ3oQiDRSjgA/cuRpy2HV66gy8sxyPZRGJq1FzuzdGHKmb
qL7kzPULAkEAyxmpNukaA60MT1Yb4i2GDNpFZkOHZbaWjb51ux/bcd4gxFOfO/8l
4GJa1CL2i7ry6jI3uo4yxMCs9Z/uNfP++QJBAO3LLTlpYGWjx+umEoYIoxEcvOH9
i7wDj4Tp9JtV6eeexfVhNIY1xD+qm58JeL3LKse+xngIYPvSJVzmJUjkmI8CQQCV
iW5ChLxnqnjezRq4nCYPvoHMerntFNOix3GtdhY/r3nWs28RYJoFrMUNXjTCysHh
11ma3OnaXba7HqboSJ8ZAkApmseSiKQiR2BjMEAV462Yzxh/fDApS0qVzQBR5KBV
yaFXNT+8mRokscUiUsSI0IUI4a1lSrBWv6cEEopgHuC1
-----END RSA PRIVATE KEY-----
KEY;
$public_key = <<<KEY
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDGdiNW38TIiIpZ2nugSk0AgXNQ
u3GHMPkKMwvelMB2V2gRu4wdtnoq4m5Xy3noYERu8QCpkvp2fc7JlyPpqXs98g+w
563WA88JH++OS840eJmc6j3JR4Y/5jX/yvq9Ykl/PvGJGNvTBuNXPbj9pwuiUDqU
7gUQLXgGqssxxuxBswIDAQAB
-----END PUBLIC KEY-----
KEY;
$data = 'abcsdsdd';
//使用公钥将数据加密
$encrypt_data = RsaUtils::publicEncrypt($data,$public_key);
//使用私钥将数据解密
$decrypt_data = RsaUtils::privateDecrypt('B5KE3bcdzLIByKqIIMuHDGkg1C-hQw9Jz8K801OjY3LljXQM7AhpSzlj18-Aiod-QlVfcmOlmaG8HINuRhcDP71J_pzhiK7sJHspzRiM0jWGF8R81yIP95iQNDUxcSsVErQixCM0nmMAWQlWYsKg-jkNZ9z8hu6PeDqSzADXETY',$private_key);

echo 'public encrypt data:'.$encrypt_data.PHP_EOL."</br>";
echo 'private decrypt data:'.$decrypt_data.PHP_EOL."</br>";


//使用私钥将数据加密
//$encrypt_data = RsaUtils::privateEncrypt($data,$private_key);
//使用私钥将加密数据加签
//$private_encrypt_sign = RsaUtils::rsaSign($encrypt_data,$private_key);
//使用公钥解签
//$public_check_sign = RsaUtils::verifySign($encrypt_data,$private_encrypt_sign,$public_key);
//使用公钥将数据解密
//$decrypt_data = RsaUtils::publicDecrypt($encrypt_data,$public_key);

//echo 'private encrypt data: '.$encrypt_data.PHP_EOL."</br>";
//echo 'private encrypt sign: '.$private_encrypt_sign.PHP_EOL."</br>";
//echo 'public check sign: '.$public_check_sign.PHP_EOL."</br>";
//echo 'public decrypt data: '.$decrypt_data.PHP_EOL."</br>";



//验证java加密解密方法
/*
$private_encrypt_data = 'fHG5JMpTTF-KzrPCp827opRy3BvqmVIpIZS4gVuWqY5NeLsgoLxdrq3SaxUp_oBQ9pVqNlEiU9SIwbqJDjIqjHsCtVMOLoEdWicib_wCaoB16veKTEC4GnvviJwlS5IedH27oWGHKTTc6Ii5cLiQncjDAadvm0KCdC74yrwPqnc';
$public_decrypt_data = RsaUtils::publicDecrypt($private_encrypt_data,$public_key);
$sign_data1 = 'jlJvXY5t8KesDi3WaPr71jj2BigHLDr3b827Jl9xspbecdUjPB44Xe3sjWnzvFDLpKJGiNTvqE-Qyu3FZpG_NyI5yhVrAQgZmyYfVywmeDDsTOQYk1xP0UEfFgB0MXsFdlfSdMu5JcR5kgC5Xl5jds1b0Z2Nq7gQ-bvFJQcuHgU';
$verify_sign1 = RsaUtils::verifySign($private_encrypt_data,$sign_data1,$public_key);

$public_encrypt_data = 'raoQQsfN0KBfPAMRWnxr9kFPvJ6BgQ7PRBCMnz0nWsH03sD4IdlMvKpj78BHe7V7Ga1HZHyDxuJhVaJ0T5qKl8qHXzvKquzNtdMru7G4X9o8ylzkGxJLg-HYCWOrsZ77ZMaKoV9p-TCf-yMI21OpL_5JGot-XNfVVPkmg0z9FW0';
$private_decrypt_data = RsaUtils::privateDecrypt($public_encrypt_data, $private_key);
$sign_data2 = 'ngN2kQppfITyn5yAfNc1c-ofK20trKJWXIjlaJhWtm7s2jzv5rcsPY5JH06CMAIIbnKGIUcoVvMeKavAIVFb4G_h3CvXIYnxMjQL19Op-SbtyGNwT-rZzTEP8tKfxFRVm7SrHHDz2s287S3vqQz9vGEGNmgDHEdrCfHBmmoFkQA';
$verify_sign2 = RsaUtils::verifySign($public_encrypt_data,$sign_data2,$public_key);

echo PHP_EOL;
echo 'public_decrypt_data: '.$public_decrypt_data.PHP_EOL;
echo 'verifySign1: '. $verify_sign1.PHP_EOL;

echo 'private_decrypt_data: '.$private_decrypt_data.PHP_EOL;
echo 'verifySign2: '. $verify_sign2.PHP_EOL;

$public_encrypt_data = 'T2LFtY3dF_b6OBO07BN-3LtMSEBZqDukovDZ4HGCff8wosvlowf6IFJ3U7LFBIeHfiHBKiFuAV8-pFltCfTXtA4AwgVUnwbBMBWBfIJiLDi02ev30V-5BcYEuSF-cEdnSUd7WecrX4rHhzYLueGuj8H6c7RRbSbrJ6_3EFfU-K0';
$private_decrypt_data = RsaUtils::privateDecrypt($public_encrypt_data,$private_key);
echo PHP_EOL;
echo 'private_decrypt_data: '.$private_decrypt_data.PHP_EOL;
*/


class RsaUtils{

    /**
     * 签名算法，SHA256WithRSA
     */
    private const SIGNATURE_ALGORITHM = OPENSSL_ALGO_SHA256;

    /**
     * RSA最大加密明文大小
     */
    private const MAX_ENCRYPT_BLOCK = 117;

    /**
     * RSA最大解密密文大小
     */
    private const MAX_DECRYPT_BLOCK = 128;

    /**
     * 使用公钥将数据加密
     * @param $data string 需要加密的数据
     * @param $publicKey string 公钥
     * @return string 返回加密串(base64编码)
     */
    public static function publicEncrypt($data,$publicKey){
        $data = str_split($data, self::MAX_ENCRYPT_BLOCK);

        $encrypted = '';
        foreach($data as & $chunk){
            if(!openssl_public_encrypt($chunk, $encryptData, $publicKey)){
                return '';
            }else{
                $encrypted .= $encryptData;
            }
        }
        return self::urlSafeBase64encode($encrypted);
    }

    /**
     * 使用私钥解密
     * @param $data string 需要解密的数据
     * @param $privateKey string 私钥
     * @return string 返回解密串
     */
    public static function privateDecrypt($data,$privateKey){
        $data = str_split(self::urlSafeBase64decode($data), self::MAX_DECRYPT_BLOCK);

        $decrypted = '';
        foreach($data as & $chunk){
            if(!openssl_private_decrypt($chunk, $decryptData, $privateKey)){
                return '';
            }else{
                $decrypted .= $decryptData;
            }
        }
        return $decrypted;
    }
    /**
     * 使用私钥将数据加密
     * @param $data string 需要加密的数据
     * @param $privateKey string 私钥
     * @return string 返回加密串(base64编码)
     */
    public static function privateEncrypt($data,$privateKey){
        $data = str_split($data, self::MAX_ENCRYPT_BLOCK);

        $encrypted = '';
        foreach($data as & $chunk){
            if(!openssl_private_encrypt($chunk, $encryptData, $privateKey)){
                return '';
            }else{
                $encrypted .= $encryptData;
            }
        }
        return self::urlSafeBase64encode($encrypted);
    }
    /**
     * 使用公钥解密
     * @param $data string 需要解密的数据
     * @param $publicKey string 公钥
     * @return string 返回解密串
     */
    public static function publicDecrypt($data,$publicKey){
        $data = str_split(self::urlSafeBase64decode($data), self::MAX_DECRYPT_BLOCK);

        $decrypted = '';
        foreach($data as & $chunk){
            if(!openssl_public_decrypt($chunk, $decryptData, $publicKey)){
                return '';
            }else{
                $decrypted .= $decryptData;
            }
        }
        return $decrypted;
    }


    /**
     * 私钥加签名
     * @param $data 被加签数据
     * @param $privateKey 私钥
     * @return mixed|string
     */
    public static function rsaSign($data, $privateKey){
        if(openssl_sign($data, $sign, $privateKey, self::SIGNATURE_ALGORITHM)){
            return self::urlSafeBase64encode($sign);
        }
        return '';
    }

    /**
     * 公钥验签
     * @param $data 被加签数据
     * @param $sign 签名
     * @param $publicKey 公钥
     * @return bool
     */
    public static function verifySign($data, $sign, $publicKey):bool {
        return (1 == openssl_verify($data, self::urlSafeBase64decode($sign), $publicKey, self::SIGNATURE_ALGORITHM));
    }

    /**
     * url base64编码
     * @param $string
     * @return mixed|string
     */
    public static function urlSafeBase64encode($string){
        $data = str_replace(array('+','/','='), array( '-','_',''), base64_encode($string));
        return $data;
    }

    /**
     * url base64解码
     * @param $string
     * @return bool|string
     */
    public static function urlSafeBase64decode($string){
        $data = str_replace(array('-','_'), array('+','/'), $string);
        $mod4 = strlen($data) % 4;
        if($mod4){
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}

