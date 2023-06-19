<?php
require_once('header.php');
if ((($_SESSION != null || '') && ($_SESSION['userRole'] == 1))) {
    require_once('CRUDLogic/selectAllOuvrages.php') ?>

<section class="content">
    <div class="d-flex justify-content-center">
        <a href="administration.php" class="btn btn-light mb-3 mx-3 w-75">Retour</a>
        <a href="ouvrage-form.php" class="btn btn-primary mb-3 mx-3 w-75">Créer</a>
    </div>
    <table id="example" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Auteur</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['ouvrage_nom'] . "</td>";
                    echo "<td>" . $row['ouvrage_auteur'] . "</td>";
                    echo "<td>" . $row['ouvrage_type'] . "</td>";
                    echo "<td><a href='ouvrage-form.php?" . $row['ouvrage_id'] . "'>Modifier</a>&nbsp;<a href='CRUDLogic/deleteOuvrage.php?" . $row['ouvrage_id'] . "'onclick='return deleteConfirm()'>Supprimer</a></td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
</section>

<script>
function deleteConfirm() {
    return window.confirm('Souhaitez-vous vraiment confirmer la suppression ?')
}
</script>

<?php require_once('footer.php');
} else {
    // Redirection vers la page des ouvrages pour les utilisateurs non admins ou non connectés
    echo '<script>window.location.href = "ouvrages.php";</script>';
} ?>