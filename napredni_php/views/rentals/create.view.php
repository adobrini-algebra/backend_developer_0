<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Kreiraj novu Posudbu</h1>
        <div class="action-buttons">
        </div>
    </div>

    <hr>
    
    <form class="row g-3 mt-3" action="/rentals/store" method="POST">

        <?php include base_path('views/rentals/partials/create-form.php') ?>
        
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Dodaj</button>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <a href="/rentals" class="btn btn-primary mb-3">Povratak</a>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>