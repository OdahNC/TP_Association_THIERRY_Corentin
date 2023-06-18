<?php

require_once('../identifiants_bdd.php');
$id = array_keys($_GET);
$userpassword = $_POST['user_password'];
$newUserPassword = $_POST['user_new_password'];
$confirmNewUserPassword = $_POST['confirm_user_new_password'];

// print_r($id);

// die();

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour insérer les données
    $query = "SELECT membre_mdp FROM membre WHERE membre_id = :id";

    $stmt = $conn->prepare($query);

    // Exécution de la requête
    $stmt->bindParam(':id', $id[0], PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        if (password_verify($userpassword, $result[0]['membre_mdp']) === true) {
            if ($newUserPassword === $confirmNewUserPassword) {

                $newUserPassword = password_hash($newUserPassword, PASSWORD_BCRYPT);

                // On efface le mot de passe de confirmation ne servant plus a rien.
                $confirmNewUserPassword = null;
                // Requête SQL pour insérer les données
                $query = "UPDATE membre SET membre_mdp = :mdp WHERE membre_id = :id";

                $stmt = $conn->prepare($query);

                // Exécution de la requête
                $stmt->bindParam(':id', $id[0], PDO::PARAM_INT);
                $stmt->bindParam(':mdp', $newUserPassword, PDO::PARAM_STR);
                $stmt->execute();

                setcookie('rememberMe', '', time() - 3600, '/');

                session_start();
                session_unset();
                session_destroy();
                $_SESSION = array();

                // On prévient que l'utillisateur est deconnecté
                echo '<script>alert("Votre mot de passe a bien été changé, veuillez vous reconnecter");</script>';

                $conn = null; // Déconnexion SQL

                // Redirection vers la page des ouvrages
                echo '<script>window.location.href = "../sign_in.php";</script>';
            } else {
                echo '<script>alert("Le nouveau mot de passe ne correspond pas à la confirmation");</script>';
                $conn = null;
                echo '<script>window.location.href = "../my-account-password-form.php";</script>';
            }
        } else {
            echo '<script>alert("Votre mot de passe actuel est invalide, veuillez réessayer");</script>';
            $conn = null;
            echo '<script>window.location.href = "../my-account-password-form.php";</script>';
        }
    } else {
        echo '<script>alert("Une erreur est survenue, veuillez réessayer");</script>';
        $conn = null;
        echo '<script>window.location.href = "../my-account-password-form.php";</script>';
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
