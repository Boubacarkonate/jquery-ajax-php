<?php
require 'db.php';

try {


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST["name"];
        $firstname = $_POST["firstname"];
        $age = $_POST["age"];

        if (!empty($name) && !empty($firstname) && !empty($age)) {
            $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, age) VALUES (:nom, :prenom, :age)");
            $stmt->bindParam(":nom", $name);
            $stmt->bindParam(":prenom", $firstname);
            $stmt->bindParam(":age", $age);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "utilisateur enregistré !"]);
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
