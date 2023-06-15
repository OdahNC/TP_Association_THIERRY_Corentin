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
            $('#example').DataTable();
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ouvrages.php">Les ouvrages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="administration.php">Administration</a>
                            <!-- <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul> -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion.php">Se connecter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <hr id="navbar-hr">
    </div>