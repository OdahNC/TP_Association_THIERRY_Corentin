<?php

require_once('../identifiants_bdd.php');

$nom = $_POST['user_firstname'];
$prenom = $_POST['user_lastname'];
$tel = $_POST['user_phone'];
$mail = $_POST['user_mail'];
$userpassword = $_POST['user_password'];

$userpassword = password_hash($userpassword, PASSWORD_BCRYPT);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour insérer les données
    $query = "INSERT INTO membre (membre_nom, membre_prenom, membre_tel, membre_mail, membre_mdp) VALUES (:nom, :prenom, :tel, :mail, :mdp)";

    $stmt = $conn->prepare($query);

    // Exécution de la requête
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':mdp', $userpassword, PDO::PARAM_STR);
    $stmt->execute();

    // On prévient que l'opération a été effectuée
    echo '<script>alert("L\'opération a été effectuée avec succès !");</script>';

    $conn = null; // Déconnexion SQL

    // Redirection vers la page des ouvrages
    echo '<script>window.location.href = "../sign_in.php";</script>';
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}