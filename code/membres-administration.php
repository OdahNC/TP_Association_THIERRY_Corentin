<?php
require_once('header.php');
if ((($_SESSION != null || '') && ($_SESSION['userRole'] == 1))) {
    require_once('CRUDLogic/selectAllMembres.php') ?>

    <section class="content">
    <div class="d-flex justify-content-center">
        <a href="administration.php" class="btn btn-light mb-3 mx-3 w-75">Retour</a>
        <a href="membre-form.php" class="btn btn-primary mb-3 mx-3 w-75">Créer</a>
    </div>
        <table id="example" class="display" style="width:100%;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mail</th>
                    <th>N° Tél</th>
                    <th>Administrateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['membre_nom'] . "</td>";
                    echo "<td>" . $row['membre_prenom'] . "</td>";
                    echo "<td>" . $row['membre_mail'] . "</td>";
                    echo "<td>" . $row['membre_tel'] . "</td>";
                    echo "<td>";
                    if ($row['membre_administrateur'] == 1) {
                        echo "<span style='color: green;'>Oui</span>";
                    } else {
                        echo "<span style='color: red;'>Non</span>";
                    }
                    echo "</td>";
                    if ($row['membre_mail'] !== 'administrateur@administrateur.nc') {
                        echo "<td><a href='membre-form.php?" . $row['membre_id'] . "'>Modifier</a>&nbsp;<a href='CRUDlogic/deleteMembre.php?" . $row['membre_id'] . "'onclick='return deleteConfirm()'>Supprimer</a></td>";
                    } else {
                        echo "<td></td>";
                    }
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
    // On prévient que l'utilisateur n'a pas accès a la ressource
    echo '<script>alert("Vous n\'avez pas accès a cette ressource. Retour aux ouvrages...");</script>';

    // Redirection vers la page des ouvrages
    echo '<script>window.location.href = "ouvrages.php";</script>';
} ?>