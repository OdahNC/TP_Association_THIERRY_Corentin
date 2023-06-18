<?php

require_once('../identifiants_bdd.php');

$nom = $_POST['nom'];
$auteur = $_POST['auteur'];
$type = $_POST['type'];
$date = $_POST['date'];
$descriptif = $_POST['descriptif'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour insérer les données
    $query = "INSERT INTO ouvrage (ouvrage_nom, ouvrage_auteur, ouvrage_type, ouvrage_date_parution, ouvrage_descriptif) VALUES (:nom, :auteur, :type, :date, :descriptif)";

    $stmt = $conn->prepare($query);

    // Exécution de la requête
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':auteur', $auteur, PDO::PARAM_STR);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':descriptif', $descriptif, PDO::PARAM_STR);
    $stmt->execute();

    // On prévient que l'opération a été effectuée
    echo '<script>alert("L\'opération a été effectuée avec succès !");</script>';

    $conn = null; // Déconnexion SQL

    // Redirection vers la page des ouvrages
    echo '<script>window.location.href = "../ouvrages-administration.php";</script>';
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
