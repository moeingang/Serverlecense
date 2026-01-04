<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "config.php";

$license = $_GET['license'] ?? '';
$product = $_GET['product'] ?? '';
$server  = $_GET['server'] ?? '';

if ($license === '' || $product === '' || $server === '') {
    die("BAD_REQUEST");
}

$stmt = $db->prepare("
    SELECT * FROM licenses
    WHERE license_key = ? AND product_id = ? AND active = 1
");
$stmt->bind_param("ss", $license, $product);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) die("INVALID");
if (strtotime($row['expires_at']) < time()) die("EXPIRED");

if ($row['server_id'] === null) {
    $u = $db->prepare("UPDATE licenses SET server_id=? WHERE id=?");
    $u->bind_param("si", $server, $row['id']);
    $u->execute();
}

if ($row['server_id'] !== $server) die("INVALID_SERVER");

echo "OK";
