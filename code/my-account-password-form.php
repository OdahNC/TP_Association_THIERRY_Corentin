<?php require_once('header.php');
require_once('identifiants_bdd.php');
$id = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : null;

?>
<section class="content">
    <div class="container">
        <h1>Modification du mot de passe</h1>
        <hr>
        <form action="accountLogic/editPasswordLogic.php?<?= $id ?>" method="POST">
            <div class="mb-3">
                <label for="user_password" class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Mot de passe actuel">
            </div>
            <div class="mb-3">
                <label for="user_new_password" class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="user_new_password" name="user_new_password" placeholder="Nouveau mot de passe">
            </div>
            <div class="mb-3">
                <label for="confirm_user_new_password" class="form-label">Confirmez votre nouveau mot de passe</label>
                <input type="password" class="form-control" id="confirm_user_new_password" name="confirm_user_new_password" placeholder="Confirmer le nouveau mot de passe">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</section>

<?php require_once('footer.php') ?>