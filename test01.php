<?php

require "config.php";
require "RsaUtils.php";
$data = 'abcsdsdd';
//使用公钥将数据加密
$encrypt_data ='sFqKA4x1Q4lhW6ThCFHVfJrxLbyhEaU7Tx1aLg5E7a+wC+3vsFTGWqHgDmGH8RY6gn0Ie5DNbAEZyxYMDCbPZzhP7m085YSYDfqEXVxBMfB+2QAJt3GKa7DxZzUkmjrJNuCbPW99syDYU5RdFbctv8P4aGNEO89K7gXfqEYzPaM=';
$abc=RsaUtils::privateDecrypt($encrypt_data,$GLOBALS['privatekey']);
echo "".$abc;
