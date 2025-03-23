<?php
$host = 'localhost';
$dbname = 'calendar';
$user = 'root';  // Change selon votre configuration
$pass = '';  // Mettez votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connecté à la bdd";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
