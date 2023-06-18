<?php
session_start();
require_once('../identifiants_bdd.php');
$date = date('Y-m-d');
// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['loggedin'])) {
    echo '<script>alert("Vous n\'avez pas accès a cette ressource. Connectez-vous ou inscrivez-vous !");</script>';

    // Redirection vers la page des ouvrages
    echo '<script>window.location.href = "../ouvrages.php";</script>';
    exit; // Arrêter l'exécution du script
}

// Vérifier si l'ID de l'ouvrage a été transmis via la méthode GET ou POST
if (isset($_GET['ouvrage_id'])) {
    $ouvrage_id = $_GET['ouvrage_id'];

    // Effectuer la logique de traitement de l'emprunt
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insérer une nouvelle ligne dans la table "emprunt"
        $query = "INSERT INTO emprunt (membre_id, ouvrage_id, emprunt_date) VALUES (:membre_id, :ouvrage_id, :emprunt_date)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':membre_id', $_SESSION['userId']);
        $stmt->bindParam(':ouvrage_id', $ouvrage_id);
        $stmt->bindParam(':emprunt_date', $date); // Utilisez la date actuelle pour la date d'emprunt
        $stmt->execute();

        // Mettre à jour les informations d'ouvrage, par exemple, en ajoutant un indicateur de disponibilité ou en mettant à jour le statut de l'ouvrage
        // $query = "UPDATE ouvrage SET disponible = 0 WHERE ouvrage_id = :ouvrage_id";
        // $stmt = $conn->prepare($query);
        // $stmt->bindParam(':ouvrage_id', $ouvrage_id);
        // $stmt->execute();


        // Rediriger l'utilisateur vers une page de confirmation ou une autre page appropriée
        echo '<script>alert("Votre emprunt a bien été pris en compte.");</script>';

        $conn = null; // Déconnexion SQL
        // Redirection vers la page des ouvrages
        echo '<script>window.location.href = "../ouvrages.php";</script>';
        exit; // Arrêter l'exécution du script
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        // Gérer l'erreur de traitement de l'emprunt, par exemple, afficher un message d'erreur approprié
    }
}
