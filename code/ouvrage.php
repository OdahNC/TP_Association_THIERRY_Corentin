<?php require_once('header.php');
require_once('CRUDLogic/selectOuvrage.php');
?>

<section class="content d-flex justify-content-center align-items-center">
    <div class="container text-center">
        <div class="row d-flex justify-content-center">
            <?php foreach ($results as $row) { ?>
                    <div class="col-sm-6">
                        <h2><?php echo $row['ouvrage_nom']; ?></h2>
                        <p><span class="text-decoration-underline">Type</span> : <?php echo $row['ouvrage_type'] ?></p>
                        <p><span class="text-decoration-underline">Auteur</span> : <?php echo $row['ouvrage_auteur'] ?></p>
                        <p><span class="text-decoration-underline">Date de parution</span> : <?php echo $row['ouvrage_date_parution'] ?></p>
                        <h6>Description :</h6>
                        <p><?php echo $row['ouvrage_descriptif']; ?></p>
                        <a href="ouvrages.php" class="btn btn-primary">Retour</a>
                    </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php require_once('footer.php') ?>