<?php
// logger.php

// 1. Tangkap IP Address
$ip_address = $_SERVER['REMOTE_ADDR'];

// 2. Tangkap Informasi Perangkat (User Agent)
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// 3. Tangkap Koordinat dari POST (JavaScript)
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '0';
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '0';
$status = isset($_POST['status']) ? $_POST['status'] : 'NO_INTERACTION';

// 4. Simpan ke file log (sebagai contoh, bisa diganti ke Database MySQL)
$log_entry = "[" . date('Y-m-d H:i:s') . "] IP: $ip_address | Lat: $latitude | Lon: $longitude | Status: $status | Device: $user_agent" . PHP_EOL;

file_put_contents('logs.txt', $log_entry, FILE_APPEND);

echo "Data tercatat.";
?>