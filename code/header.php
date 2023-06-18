<?php session_start();

if (isset($_COOKIE['rememberMe']) && !isset($_SESSION['loggedin'])) {
    require_once('identifiants_bdd.php');
    $sessionId = $_COOKIE['rememberMe'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer les informations de l'utilisateur basées sur l'identifiant de session
        $query = "SELECT * FROM membre WHERE membre_session_id = :sessionId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':sessionId', $sessionId, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            $_SESSION['loggedin'] = true;
            $_SESSION['userMail'] = $results[0]['membre_mail'];
            $_SESSION['userId'] = $results[0]['membre_id'];
            $_SESSION['userFirstName'] = $results[0]['membre_nom'];
            $_SESSION['userLastName'] = $results[0]['membre_prenom'];
            $_SESSION['userRole'] = $results[0]['membre_administrateur'];
        }

        $conn = null; // Déconnexion SQL
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css?<?= time() ?>">
    <link rel="stylesheet" href="css/footer.css?<?= time() ?>">

    <!-- Intégration de fontawesome -->
    <link rel="stylesheet" href="fontawesome-free/css/all.css">
    <script src="fontawesome-free/js/fontawesome.js"></script>
    <!-- ************************************ -->

    <!-- Intégration de jQuery -->
    <script src="jQuery/jquery.min.js"></script>
    <!-- ************************************ -->


    <!-- Intégration de DataTablesBs5 -->
    <link href="DataTables/datatables.min.css" rel="stylesheet" />
    <script src="DataTables/datatables.min.js"></script>
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "lengthMenu": "Affiche _MENU_ enregistrements",
                    "info": "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                    "search": "Rechercher :",
                    "paginate": {
                        "next": "Suivant",
                        "previous": "Précédent"
                    }
                }
            });
        });
    </script>
    <!-- ************************************ -->

    <!-- Intégration de Bootstrap 5.3 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- ************************************ -->

    <title>Association</title>
</head>

<body>
    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img id="navbar-logo" src="img/grand_logo.jpg" alt="logo_of_the_page"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse me-2" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ouvrages.php">Les ouvrages</a>
                        </li>
                        <?php if (($_SESSION != null || '') && ($_SESSION['userRole'] == 1)) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="administration.php">Administration</a>
                            </li>
                        <?php endif ?>

                        <?php if ($_SESSION != null || '') : ?>
                            <?php $user = $_SESSION['userLastName']; ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" href="sign_in.php"><?php echo $user; ?></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="my-account.php">Mon compte</a></li>
                                    <li><a class="dropdown-item" href="my-loans.php">Mes emprunts</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="connectionLogic/disconnect_logic.php">Se déconnecter</a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="sign_in.php">Se connecter</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
        <hr id="navbar-hr">
    </div>