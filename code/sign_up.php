<?php require_once('header.php') ?>

<div class="content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">S'inscrire</h5>
                        <hr>
                        <form action="connectionLogic/sign_up_logic.php" method="POST" onsubmit="return checkInformations()">
                            <div class="mb-3">
                                <label for="user_firstname" class="form-label">Votre nom de famille</label>
                                <input type="text" class="form-control" id="user_firstname" name="user_firstname" placeholder="Votre nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="user_lastname" class="form-label">Votre prénom</label>
                                <input type="text" class="form-control" id="user_lastname" name="user_lastname" placeholder="Votre prénom" required>
                            </div>
                            <div class="mb-3">
                                <label for="user_phone" class="form-label">Votre numéro de téléphone</label>
                                <input type="tel" class="form-control" id="user_phone" name="user_phone" placeholder="00.00.00" required>
                            </div>
                            <div class="mb-3">
                                <label for="user_mail" class="form-label">Votre Email</label>
                                <input type="email" class="form-control" id="user_mail" name="user_mail" placeholder="monmail@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="user_password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Votre mot de passe" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_user_password" class="form-label">Confirmer mot de passe</label>
                                <input type="password" class="form-control" id="confirm_user_password" name="confirm_user_password" placeholder="Confirmez votre mot de passe" required>
                                <p id="password-error" class="error-message" style="color: red; display: none;">Les mots
                                    de passe ne correspondent pas.</p>
                            </div>
                            <div class="d-flex flex-column flex-lg-row justify-content-center gap-3">
                                <input type="submit" value="S'inscrire" class="btn btn-primary w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkInformations() {
        // Récupére les valeurs des champs du formulaire
        var userFirstName = document.getElementById('user_firstname').value;
        var userLastName = document.getElementById('user_lastname').value;
        var userPhone = document.getElementById('user_phone').value;
        var userMail = document.getElementById('user_mail').value;
        var userPassword = document.getElementById('user_password').value;
        var confirmUserPassword = document.getElementById('confirm_user_password').value;

        // Effectuer les validations nécessaires
        if (userFirstName.trim() === '') {
            alert("Veuillez entrer votre nom de famille.");
            return false; // Empêche l'envoi du formulaire
        }
        // Vérifier si les mots de passe correspondent
        if (userPassword !== confirmUserPassword) {
            document.getElementById('password-error').style.display = 'block';
            return false; // Empêche l'envoi du formulaire
        } else {
            document.getElementById('password-error').style.display = 'none';
        }
        return true;
    }
</script>

<?php require_once('footer.php') ?>