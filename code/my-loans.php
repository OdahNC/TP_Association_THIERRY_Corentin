<?php require_once('header.php')?>

<?php

require_once('identifiants_bdd.php');

$id = $_SESSION['userId'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer les données
    $query = "SELECT o.ouvrage_nom, e.emprunt_date
              FROM emprunt AS e
              JOIN ouvrage AS o ON e.ouvrage_id = o.ouvrage_id
              WHERE e.membre_id = :membre_id";


    $stmt = $conn->prepare($query);
    // Exécution de la requête
    $stmt->bindParam(':membre_id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Récupération des résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
$conn = null; // Déconnexion SQL

?>

<section class="content">
    <table id="example" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Nom de l'ouvrage</th>
                <th>Date de l'emprunt</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['ouvrage_nom'] . "</td>";
                echo "<td>" . $row['emprunt_date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<?php require_once('footer.php') ?>