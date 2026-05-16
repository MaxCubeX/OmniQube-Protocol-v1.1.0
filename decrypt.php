<?php
require 'config.php';

$data = json_decode(file_get_contents('data/encrypted_link.txt'), true);
if (!$data) {
    die(json_encode(['error' => 'No encrypted data found']));
}

$encrypted_link = $data['encrypted_link'];
$hmac = $data['hmac'];

if (hash_hmac('sha256', $encrypted_link, SECRET_KEY) !== $hmac) {
    die(json_encode(['error' => 'HMAC validation failed']));
}

$link = decryptLink($encrypted_link, SECRET_KEY);
echo json_encode(['success' => true, 'link' => $link]);
?>
