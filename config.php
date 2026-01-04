<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new mysqli(
    "sql111.infinityfree.com",
    "if0_40393088",
    "ZHBbKEfrGoxBuhO",
    "if0_40393088_XXX",
    3306
);

if ($db->connect_error) {
    die("DB_ERROR: " . $db->connect_error);
}

$db->set_charset("utf8mb4");
