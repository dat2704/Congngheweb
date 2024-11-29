<?php
    $host = '127.0.0.1';
    $db   = 'flowers_db';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        // Kết nối đến cơ sở dữ liệu
        $pdo = new PDO($dsn, $user, $pass, $options);
        //echo "Kết nối cơ sở dữ liệu thành công!";
    } catch (\PDOException $e) {
        // Nếu có lỗi xảy ra, in ra thông báo lỗi
        echo "Kết nối thất bại: " . $e->getMessage();
    }
?>