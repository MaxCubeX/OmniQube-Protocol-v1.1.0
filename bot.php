<?php
require 'config.php';

function generateNewEncryptedLink() {
    $link = "https://example.com";
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($link, 'aes-256-cbc', SECRET_KEY, 0, $iv);
    $encrypted_link = base64_encode($iv . '::' . $encrypted);
    $hmac = hash_hmac('sha256', $encrypted_link, SECRET_KEY);

    file_put_contents('data/encrypted_link.txt', json_encode([
        'encrypted_link' => $encrypted_link,
        'hmac' => $hmac,
        'timestamp' => time()
    ]));
}

generateNewEncryptedLink();
echo json_encode(['success' => true, 'message' => 'Ссылка обновлена ботом']);
?>
