<?php

require_once('identifiants_bdd.php');
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les données
    $query = "SELECT * FROM ouvrage";

    // Exécution de la requête
    $stmt = $conn->query($query);

    // Récupération des résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null; // Déconnexion SQL

// Fonction pour raccourcir une chaîne de caractères avec des points de suspension
function shortenText($text, $maxLength)
{
    if (strlen($text) > $maxLength) {
        $shortText = substr($text, 0, $maxLength - 3) . '...';
        return $shortText;
    } else {
        return $text;
    }
}