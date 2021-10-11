<?php

require "config.php";
require "RsaUtils.php";
$data = 'abcsdsdd';
//使用公钥将数据加密
$encrypt_data = RsaUtils::publicEncrypt($data,$GLOBALS['publickey']);
echo "".$encrypt_data;