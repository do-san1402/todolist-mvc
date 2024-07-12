<?php

use App\App\App; ?>
<?php require 'views/layouts/main.php' ?>

<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a href="<?php echo App::get('config')['APP_URL'] ?>" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>