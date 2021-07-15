<?php
    class Scrambler {
        static public function sha3($msg, $rounds, $salt='') {
            $res = $msg . $rounds . $salt;
            for ($i = 0; $i < $rounds; $i++) {
                $res = hash('sha3-512', $msg . $res . $salt);
                $res = strrev($res);
            }
            return $res;
        }
        static public function generateUid() {
            $data = date(DATE_ATOM);
            $preuid = self::sha3($data, 1024, str_repeat($data, 1024)) . $_SERVER['REMOTE_ADDR'];
            $uid = self::sha3($preuid, 1024, str_repeat($preuid, 1024));
            return $uid;
        }
        static public function generateKey() {
            $sha3Key = self::sha3(bin2hex(random_bytes(4096)), 1024, bin2hex(random_bytes(4096)));
            $key = openssl_encrypt($sha3Key, 'aes-256-cbc', $sha3Key, $options=0, random_bytes(16));
            return $key;
        }
        static public function generateIV() {
            return random_bytes(16);
        }
        static public function encrypt($message, $key, $iv) {
            $encrypt = openssl_encrypt($message, 'aes-256-cbc', $key, $options=0, $iv);
            return $encrypt;
        }
        static public function decrypt($message, $key, $iv) {
            $result = openssl_decrypt($message, 'aes-256-cbc', $key, $options=0, $iv);
            return $result;
        }
    }
?>