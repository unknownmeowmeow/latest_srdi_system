<?php
session_start();
require_once "./controller/main.php";

$user_id = $_SESSION['user_id'] ?? 0;
$type_id = $_SESSION['type_id'] ?? 0;

$db = new db();

$db->markNotificationsAsRead($user_id, $type_id);

echo "OK";
