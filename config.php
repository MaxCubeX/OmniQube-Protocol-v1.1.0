<?php

define('SECRET_KEY', 'your-secure-random-key');

function encryptLink($link, $key) {
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($link, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . '::' . $encrypted);
}

function decryptLink($encrypted, $key) {
    list($iv, $encrypted_data) = explode('::', base64_decode($encrypted), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}

?>
