<?php require_once('header.php') ?>

<?php

require_once('identifiants_bdd.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les données
    $query = "SELECT o.ouvrage_nom, m.membre_nom, m.membre_prenom, m.membre_mail, e.* FROM emprunt AS e
    LEFT JOIN ouvrage AS o ON e.ouvrage_id = o.ouvrage_id
    LEFT JOIN membre AS m ON e.membre_id = m.membre_id";


    $stmt = $conn->prepare($query);
    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
$conn = null; // Déconnexion SQL

?>

<section class="content">
    <div class="d-flex justify-content-center">
        <a href="administration.php" class="btn btn-primary mb-3 mx-3 w-75">Retour</a>
    </div>
    <table id="example" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Nom de l'ouvrage</th>
                <th>Nom du membre</th>
                <th>Prénom du membre</th>
                <th>Mail du membre</th>
                <th>Date de l'emprunt</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['ouvrage_nom'] . "</td>";
                echo "<td>" . $row['membre_nom'] . "</td>";
                echo "<td>" . $row['membre_prenom'] . "</td>";
                echo "<td>" . $row['membre_mail'] . "</td>";
                echo "<td>" . $row['emprunt_date'] . "</td>";
                echo "<td><a href='empruntLogic/emprunt_suppression.php?" . $row['emprunt_id'] . " 'onclick='return deleteConfirm()'>Supprimer</a>&nbsp;<a href='#?" . $row['ouvrage_id'] . "'onclick='return reportConfirm()'>Signaler état</a></td>";

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

    function reportConfirm() {
        return window.confirm('Souhaitez-vous vraiment confirmer le signalement ?')
    }
</script>


<?php require_once('footer.php') ?>