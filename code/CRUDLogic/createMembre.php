<?php

require_once('../identifiants_bdd.php');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$mail = $_POST['mail'];
$profil = isset($_POST['userAdmin']);
$tempPassword = $_POST['user_password'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour insérer les données
    if ($profil) {
        $query = "INSERT INTO membre (membre_nom, membre_prenom, membre_tel, membre_mail, membre_mdp, membre_administrateur) VALUES (:nom, :prenom, :tel, :mail, :mdp, :userprofil)";

        $stmt = $conn->prepare($query);

        // Exécution de la requête
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':mdp', $tempPassword, PDO::PARAM_STR);
        $stmt->bindParam(':userprofil', $profil, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        $query = "INSERT INTO membre (membre_nom, membre_prenom, membre_tel, membre_mail, membre_mdp) VALUES (:nom, :prenom, :tel, :mail, :mdp)";

        $stmt = $conn->prepare($query);

        // Exécution de la requête
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':mdp', $tempPassword, PDO::PARAM_STR);
        $stmt->execute();
    }

    // On prévient que l'opération a été effectuée
    echo '<script>alert("L\'opération a été effectuée avec succès !");</script>';

    $conn = null; // Déconnexion SQL

    // Redirection vers la page des ouvrages
    echo '<script>window.location.href = "../membres-administration.php";</script>';
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
