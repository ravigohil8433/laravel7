<?php

namespace App\Libraries;

class MCrypt
{
	private $iv = 'fedcba9876543210'; #Same as in JAVA
	private $key = '0123456789abcdef'; #Same as in JAVA


	function __construct() {
		error_reporting(E_ALL ^ E_DEPRECATED);
	}

	function encrypt($str) {
        $str = base64_encode($str);
        $iv = $this->iv;
        $encrypted = openssl_encrypt($str, 'AES-128-CBC', $this->key, OPENSSL_RAW_DATA, $iv);
        return bin2hex($encrypted);
    }

    function decrypt($code) {
		if($code){
			if(strlen($code) % 2 == 0) {
				$iv = $this->iv;
				$decrypted= openssl_decrypt(hex2bin($code), 'AES-128-CBC', '0123456789abcdef', OPENSSL_RAW_DATA, 'fedcba9876543210');
				$decrypted = base64_decode(trim($decrypted));
				return trim($decrypted);
			} else {
				return null;
			}
		} else {
			return null;
		}
    }
}
