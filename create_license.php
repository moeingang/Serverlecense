<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "config.php";

$product = "ANTI_CHEAT";
$licenseKey = strtoupper(md5(uniqid(mt_rand(), true)));
$createdAt = date("Y-m-d H:i:s");
$expiresAt = date("Y-m-d H:i:s", strtotime("+7 days"));

$stmt = $db->prepare("
    INSERT INTO licenses
    (license_key, product_id, created_at, expires_at, active)
    VALUES (?, ?, ?, ?, 1)
");

$stmt->bind_param("ssss", $licenseKey, $product, $createdAt, $expiresAt);
$stmt->execute();

echo "<b>LICENSE CREATED</b><br>";
echo "KEY: " . $licenseKey . "<br>";
echo "EXPIRES: " . $expiresAt;
