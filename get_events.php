<?php
$host = 'localhost';
$dbname = 'calendar';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, titre AS title, debut AS start FROM events");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($events);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
