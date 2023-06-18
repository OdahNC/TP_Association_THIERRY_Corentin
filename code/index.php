<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?<?= time() ?>">

    <!-- Intégration de Bootstrap 5.3 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- ************************************ -->

    <title>Association</title>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        .jumbotron {
            background-color: #F55551;
            color: white;
            padding: 3rem;
            flex: 1;
        }

        .book-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .book-description {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .cta-button {
            font-size: 1.25rem;
            padding: 0.75rem 2rem;
        }
    </style>
</head>


<body>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-2">L'Association Librairie Social Club Nouméa</h1>
            <h2 class="display-6 ">Vous vous situez actuellement sur la page d'Accueil</h2>
            <hr class="my-4">
            <p class="lead">Découvrez une association passionée par les connaissances et les aventures que réserve la littérature.</p>
            <a href="ouvrages.php" class="btn btn-light cta-button">Voir les Ouvrages</a>
        </div>
    </div>
</body>

</html>