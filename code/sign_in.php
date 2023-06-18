<?php require_once('header.php') ?>

<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Connexion</h5>
                        <hr>
                        <form action="connectionLogic/sign_in_logic.php" method="POST" onsubmit="return checkInformations()">
                            <div class="mb-3">
                                <label for="user_mail" class="form-label">Nom d'utilisateur</label>
                                <input type="email" class="form-control" id="user_mail" name="user_mail" placeholder="monmail@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="user-password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Votre mot de passe">
                            </div>
                            <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                            </div>
                            <div class="d-flex flex-column flex-lg-row justify-content-center gap-3">
                            <input type="submit" value="Se connecter" class="btn btn-primary w-100">
                                <a href="password_forgeted.php" class="btn btn-light w-100">Mot de passe oublié ?</a>
                            </div>
                            <hr>
                            <div class="text-center">
                                <p>Pas de compte ?</p>
                                <a class="btn btn-primary w-50" href="sign_up.php">S'inscrire</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkInformations()
    {
        return true;
    }
</script>

<?php require_once('footer.php') ?>