<?php require_once 'header.php' ?>

<div class="content d-flex align-items-center">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 col-md-6 d-flex justify-content-center">
                <div class="card" style="width: 18rem; margin-top: 20px; margin-bottom: 20px;">
                    <i class="fa-solid fa-user-pen" style="font-size: 70px; margin-top: 10px;"></i>
                    <div class="card-body">
                        <h5 class="card-title">Modifier mes informations</h5>
                        <p class="card-text">Modifier ses informations au besoin.</p>
                        <a href="my-account-form.php" class="btn btn-primary">Modifier</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 d-flex justify-content-center">
                <div class="card" style="width: 18rem; margin-top: 20px; margin-bottom: 20px;">
                    <i class="fa-solid fa-lock" style="font-size: 70px; margin-top: 10px;"></i>
                    <div class="card-body">
                        <h5 class="card-title">Modifier mon mot de passe</h5>
                        <p class="card-text">Modifier votre mot de passe.</p>
                        <a href="my-account-password-form.php" class="btn btn-primary">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php' ?>