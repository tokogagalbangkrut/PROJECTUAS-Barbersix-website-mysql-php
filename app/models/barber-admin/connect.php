<?php
    // Konfigurasi Base URL Aplikasi (otomatis menyesuaikan lokasi folder project)
    if (!defined('BASE_URL')) {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
        $projectRoot = rtrim(str_replace('\\', '/', dirname(__DIR__, 3)), '/');
        $basePath = str_replace($docRoot, '', $projectRoot);
        $basePath = '/' . trim($basePath, '/') . '/';
        define('BASE_URL', $protocol . '://' . $host . $basePath);
    }

    $dsn = 'mysql:host=localhost;dbname=barbershop';
    $user = 'root';
    $pass = '';
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    try
    {
        $con = new PDO($dsn,$user,$pass,$option);
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo 'Good Very Good !';
    }
    catch(PDOException $ex)
    {
        echo "Failed to connect with database ! ".$ex->getMessage();
        die();
    }
?>