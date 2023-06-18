<?php require_once('header.php');
$id = array_keys($_GET);

// Récupération des données
if (!empty($_GET)) {
    require_once('identifiants_bdd.php');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer les données
        $query = "SELECT ouvrage_nom, ouvrage_auteur, ouvrage_type, ouvrage_date_parution, ouvrage_descriptif FROM ouvrage WHERE ouvrage_id = :id";

        $stmt = $conn->prepare($query);

        // Exécution de la requête
        $stmt->bindParam(':id', $id[0], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $nom = $row['ouvrage_nom'];
        $auteur = $row['ouvrage_auteur'];
        $type = $row['ouvrage_type'];
        $date = $row['ouvrage_date_parution'];
        $descriptif = $row['ouvrage_descriptif'];
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null; // Déconnexion SQL
}

?>
<section class="content">
    <div class="container">
        <form action="<?php echo $id != null ? 'CRUDLogic/editOuvrage.php?' . $id[0] : 'CRUDLogic/createOuvrage.php' ?>" id="ouvrage-form" class="mt-4" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de l'ouvrage" value="<?= isset($nom) ? $nom : '' ?>">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="Type de l'ouvrage" value="<?= isset($type) ? $type : '' ?>">
            </div>
            <div class="mb-3">
                <label for="auteur" class="form-label">Auteur</label>
                <input type="text" class="form-control" id="auteur" name="auteur" placeholder="Nom & Prénom de l'auteur" value="<?= isset($auteur) ? $auteur : '' ?>">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Année de parution</label>
                <input type="number" class="form-control" id="date" name="date" placeholder="AAAA" value="<?= isset($date) ? $date : '' ?>">
            </div>
            <div class="mb-3">
                <label for="descriptif" class="form-label">Descriptif</label>
                <textarea class="form-control" id="descriptif" name="descriptif" rows="4" placeholder="Descriptif de l'ouvrage"><?= isset($descriptif) ? $descriptif : '' ?></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</section>

<?php require_once('footer.php') ?>