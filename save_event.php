<?php
$host = 'localhost';
$dbname = 'calendar';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $titre = $_POST["title"];
        $debut = $_POST["start"];

        if (!empty($titre) && !empty($debut)) {
            $stmt = $pdo->prepare("INSERT INTO events (titre, debut) VALUES (:titre, :debut)");
            $stmt->bindParam(":titre", $titre);
            $stmt->bindParam(":debut", $debut);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Événement enregistré !"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Erreur lors de l'enregistrement"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Champs vides détectés"]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Erreur : " . $e->getMessage()]);
}
