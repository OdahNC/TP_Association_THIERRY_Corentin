<?php

require_once('../identifiants_bdd.php');

$id = array_keys($_GET);
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$mail = $_POST['mail'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour insérer les données
    $query = "UPDATE membre SET membre_nom = :nom, membre_prenom = :prenom, membre_tel = :tel, membre_mail = :mail WHERE membre_id = :id";

    $stmt = $conn->prepare($query);

    // Exécution de la requête
    $stmt->bindParam(':id', $id[0], PDO::PARAM_INT);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':tel', $telephone, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->execute();

    setcookie('rememberMe', '', time() - 3600, '/');

    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    // On prévient que l'opération a été effectuée
    echo '<script>alert("L\'opération a été effectuée avec succès, veuillez vous reconnecter !");</script>';

    $conn = null; // Déconnexion SQL

    // Redirection vers la page des ouvrages
    echo '<script>window.location.href = "../sign_in.php";</script>';
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
