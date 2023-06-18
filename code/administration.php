<!-- Intégration du header -->
<?php require_once('header.php') ?>

<section class="content d-flex align-items-center">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-4 col-md-4 d-flex justify-content-center">
                <div class="card" style="width: 18rem; margin-top: 20px; margin-bottom: 20px;">
                    <i class="fa-solid fa-book-open" style="font-size: 70px; margin-top: 10px;"></i>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les ouvrages</h5>
                        <p class="card-text">Gérer les ouvrages présents dans l'intranet</p>
                        <a href="ouvrages-administration.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 d-flex justify-content-center">
                <div class="card" style="width: 18rem; margin-top: 20px; margin-bottom: 20px;">
                    <i class="fa-solid fa-user-large" style="font-size: 70px; margin-top: 10px;"></i>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les membres</h5>
                        <p class="card-text">Gérer les membres présents dans l'intranet</p>
                        <a href="membres-administration.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 d-flex justify-content-center">
                <div class="card" style="width: 18rem; margin-top: 20px; margin-bottom: 20px;">
                    <i class="fa-solid fa-user-tag" style="font-size: 70px; margin-top: 10px;"></i>
                    <div class="card-body">
                        <h5 class="card-title">Gérer les emprunts</h5>
                        <p class="card-text">Gérer les membres présents dans l'intranet</p>
                        <a href="emprunts-administration.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Intégration du footer -->
<?php require_once('footer.php') ?>