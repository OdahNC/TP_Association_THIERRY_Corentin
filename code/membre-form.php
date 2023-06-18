<?php require_once('header.php');
$id = array_keys($_GET);

// Récupération des données
if (!empty($_GET)) {
    require_once('identifiants_bdd.php');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer les données
        $query = "SELECT membre_nom, membre_prenom, membre_tel, membre_mail, membre_administrateur FROM membre WHERE membre_id = :id";

        $stmt = $conn->prepare($query);

        // Exécution de la requête
        $stmt->bindParam(':id', $id[0], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $nom = $row['membre_nom'];
        $prenom = $row['membre_prenom'];
        $telephone = $row['membre_tel'];
        $mail = $row['membre_mail'];
        $profil = $row['membre_administrateur'];
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null; // Déconnexion SQL
}

$tempPassword = generateTempPassword();

function generateTempPassword()
{
    $length = 16; // Longueur de l'identifiant de session
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $tempPassword = '';

    for ($i = 0; $i < $length; $i++) {
        $tempPassword .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $tempPassword;
}

?>
<section class="content">
    <div class="container">
        <h1 class="text-center"><?php if ($id != null || '') {
                                    echo 'Modifier l\'utilisateur' . PHP_EOL . $nom . PHP_EOL . $prenom;
                                } else {
                                    echo 'Créer un utilisateur';
                                } ?></h1>
        <hr>
        <form action="<?php echo $id != null ? 'CRUDLogic/editMembre.php?' . $id[0] : 'CRUDLogic/createMembre.php' ?>" id="ouvrage-form" class="mt-4" method="post">
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
            <div class="form-check mb-3">
                <label class="form-check-label" for="userAdmin">Administrateur</label>
                <input type="checkbox" class="form-check-input" id="userAdmin" name="userAdmin" <?php echo isset($profil) && $profil == 1 ? 'checked' : null ?>>
            </div>
            <?php if ($id == null || '') : ?>
                <div class="mb-3 d-none">
                    <label for="user_password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" value="<?php echo $tempPassword; ?>">
                </div>
                <div class="text-center mb-3">
                    <i class="fa-solid fa-circle-info" style="font-size: 15px; color: #007bff;"></i><span style="font-size: 13px">Un mot de passe temporaire sera envoyé a l'utilisateur</span>
                </div>
            <?php endif ?>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</section>

<?php require_once('footer.php') ?>