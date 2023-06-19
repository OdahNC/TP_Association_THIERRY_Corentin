<?php
require_once('../identifiants_bdd.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usermail = $_POST['user_mail'];
    $userpassword = $_POST['user-password'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer les informations de l'utilisateur basées sur l'adresse e-mail
        $query = "SELECT * FROM membre WHERE membre_mail = :usermail";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':usermail', $usermail, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            if (password_verify($userpassword, $results[0]['membre_mdp'])) {
                // Génération d'un identifiant de session persistant
                $sessionId = generateUniqueSessionId();

                // Enregistrement de l'identifiant de session dans la base de données
                $query = "UPDATE membre SET membre_session_id = :sessionId WHERE membre_mail = :usermail";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
                $stmt->bindParam(':usermail', $usermail, PDO::PARAM_STR);
                $stmt->execute();

                $_SESSION['loggedin'] = true;
                $_SESSION['userMail'] = $usermail;
                $_SESSION['userId'] = $results[0]['membre_id'];
                $_SESSION['userFirstName'] = $results[0]['membre_nom'];
                $_SESSION['userLastName'] = $results[0]['membre_prenom'];
                $_SESSION['userRole'] = $results[0]['membre_administrateur'];

                if (isset($_POST['rememberMe'])) {
                    // Stockage de l'identifiant de session dans le cookie
                    setcookie('rememberMe', $sessionId, time() + 86400 * 30, '/');
                }
            }
        } else {
            // On prévient qu'une erreur est survenue
            echo '<script>alert("L\'identifiant et le mot de passe ne correspondent pas ou n\'existent pas");</script>';
            $conn = null; // On déconnecte SQL
            echo '<script>window.location.href = "../sign_in.php";</script>';
        }
        $conn = null; // Déconnexion SQL

        // On salue l'uilisateur
        echo '<script>alert("Bonjour ' . $_SESSION['userFirstName'] . ' ' . $_SESSION['userLastName'] . '");</script>';

        // Redirection vers la page des ouvrages
        echo '<script>window.location.href = "../ouvrages.php";</script>';
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function generateUniqueSessionId()
{
    $length = 32; // Longueur de l'identifiant de session
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $sessionId = '';

    for ($i = 0; $i < $length; $i++) {
        $sessionId .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $sessionId;
}
