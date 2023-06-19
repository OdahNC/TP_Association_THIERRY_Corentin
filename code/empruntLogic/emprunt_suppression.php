<?php

require_once('../identifiants_bdd.php');
if (isset($_GET['emprunt_id'])) {
    $id = $_GET['emprunt_id'];
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les données
    $query = "DELETE FROM emprunt WHERE emprunt_id = :id";

    $stmt = $conn->prepare($query);

    // Exécution de la requête
    $id = array_keys($_GET);
    $stmt->bindParam(':id', $id[0], PDO::PARAM_INT);
    $stmt->execute();
    // On prévient que l'opération a été effectuée
    echo '<script>alert("La suppression de l\'emprunt a été effectuée avec succès !");</script>';
    $conn = null; // Déconnexion SQL

    // Redirection vers la page des ouvrages
    echo '<script>window.location.href = "../ouvrages-administration.php";</script>';
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
