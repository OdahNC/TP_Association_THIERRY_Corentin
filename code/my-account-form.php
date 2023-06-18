<?php require_once('header.php');
$id = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : null;

// Récupération des données
if ($id != null) {
    require_once('identifiants_bdd.php');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer les données
        $query = "SELECT membre_nom, membre_prenom, membre_tel, membre_mail FROM membre WHERE membre_id = :id";

        $stmt = $conn->prepare($query);

        // Exécution de la requête
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $nom = $row['membre_nom'];
        $prenom = $row['membre_prenom'];
        $telephone = $row['membre_tel'];
        $mail = $row['membre_mail'];
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null; // Déconnexion SQL
}

?>
<section class="content">
    <div class="container">
        <h1>Modifier mes informations</h1>
        <hr>
        <form action="accountLogic/editAccount.php?<?= $id ?>" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom du membre" value="<?= isset($nom) ? $nom : '' ?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom du membre" value="<?= isset($prenom) ? $prenom : '' ?>">
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Teléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone du membre" value="<?= isset($telephone) ? $telephone : '' ?>">
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Email</label>
                <input type="email" class="form-control" id="mail" name="mail" placeholder="user@user.com" value="<?= isset($mail) ? $mail : '' ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</section>

<?php require_once('footer.php') ?>