<?php

require_once('identifiants_bdd.php');
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les données
    $query = "SELECT * FROM membre";

    // Exécution de la requête
    $stmt = $conn->query($query);

    // Récupération des résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null; // Déconnexion SQL