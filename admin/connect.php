<?php
function connectDatabase()
{
    // $host = 'localhost';
    // $dbname = 'lafsatv_letsfame';
    // $username = 'lafsatv_letsfame';
    // $password = 'BBcwm7TjkB7';

    $host = "172.31.47.158";
    $username = "letsfame";
    $password = "Letsfame@123#123";
    $dbname = "letsfameblog";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . $e->getMessage()]));
    }
}
