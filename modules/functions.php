<?php

function connectDB($config) {
    $conn = new mysqli($config['DB_SERVERNAME'], $config['DB_USERNAME'], $config['DB_PASSWORD'], $config['DB_NAME']);
    if ($conn->connect_error) {
        return false;
    } else {
        $conn->set_charset("utf8mb4");
        return $conn;
    }
}

function insertLog($conn, $path, $sql) {
    $user_ip = getUserIP();
    $now = getNow();

    $log_sql = "INSERT INTO logs (ip, path, sql_record, created_at) VALUES (?, ?, ?, ?)";
    $log_stmt = $conn->prepare($log_sql);
    $log_stmt->bind_param("ssss", $user_ip, $path, $sql, $now);
    if ($log_stmt->execute()) {
        $log_stmt->close();
        return true;
    } else {
        $log_stmt->close();
        return "錯誤: " . $log_sql . "<br>" . $conn->error;
    }
}

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function checkUserIP($config, $text = null) {
    $ip = getUserIP();
    if (!in_array($ip, $config['ALLOWED_IP'])) {
        return true;
    } else {
        if (is_null($text)) {
            $text = "入侵警報！[" . $ip . "] 嘗試更改你東西";
        } else {
            $text = "[" . $ip . "] " . $text;
        }
        $conn = connectDB($config);
        insertLog($conn, $_SERVER['REQUEST_URI'], $text);
        return false;
    }
}

function checkHasInvasion($conn) {
    $sql = "SELECT COUNT(ip) as times, ip FROM logs WHERE sql_record LIKE '入侵警報%' GROUP BY ip";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $stmt->close();
    return $rows;
}

function getNow() {
    $now = new DateTime('now', new DateTimeZone('Asia/Taipei'));
    return $now->format('Y-m-d H:i:s');
}
