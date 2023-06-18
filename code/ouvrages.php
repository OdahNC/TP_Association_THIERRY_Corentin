<!-- Intégration du header -->
<?php require_once('header.php');
require_once('identifiants_bdd.php');
// require_once('CRUDLogic/selectAllOuvrages.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour insérer les données
    $query = "SELECT o.*, e.emprunt_id FROM ouvrage AS o LEFT JOIN emprunt AS e ON o.ouvrage_id = e.ouvrage_id";

    $stmt = $conn->prepare($query);

    // Exécution de la requête
    $stmt->execute();
    $ouvrages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null; // Déconnexion SQL

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
function shortenText($text, $maxLength)
{
    if (strlen($text) > $maxLength) {
        $shortText = substr($text, 0, $maxLength - 3) . '...';
        return $shortText;
    } else {
        return $text;
    }
}
?>

<section class="content">
    <div class="container text-center">
        <div class="row">
            <?php foreach ($ouvrages as $row) { ?>
                <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                    <div class="card" style="width: 18rem; margin-top: 20px; margin-bottom: 20px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['ouvrage_nom']; ?></h5>
                            <p><span class="text-decoration-underline">Type</span> : <?php echo $row['ouvrage_type'] ?></p>
                            <p><span class="text-decoration-underline">Auteur</span> : <?php echo $row['ouvrage_auteur'] ?></p>
                            <p><span class="text-decoration-underline">Date de parution</span> : <?php echo $row['ouvrage_date_parution'] ?></p>
                            <h6>Description :</h6>
                            <p class="card-text"><?php echo shortenText($row['ouvrage_descriptif'], 120); ?></p>
                            <form action="ouvrage.php" method="get"></form>
                            <a href="ouvrage.php?<?= $row['ouvrage_id'] ?>" class="btn btn-primary mb-2">En savoir +</a>
                            <?php if ($row['emprunt_id']) : ?>
                                <p style="color: red; font-weight:600;">Non disponible</p>
                            <?php else : ?>
                                <?php if (isset($_SESSION['loggedin'])) : ?>
                                    <form action="empruntLogic/traitement_emprunt.php" method="GET">
                                        <input type="hidden" name="ouvrage_id" value="<?= $row['ouvrage_id'] ?>">
                                        <input type="submit" class="btn btn-success" onclick="return empruntConfirmation()" value="Emprunter">
                                    </form>
                                <?php endif; ?>
                                <p style="color: green; font-weight:600;">Disponible</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script>
    function empruntConfirmation() {
        return window.confirm('Souhaitez-vous vraiment confirmer l\'emprunt de l\'ouvrage ?')
    }
</script>

<!-- Intégration du footer -->
<?php require_once('footer.php') ?>