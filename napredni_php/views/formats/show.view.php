<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Medij <?= $format['tip'] ?></h1>
        <div class="action-buttons">
        </div>
    </div>
    <hr>
    <form class="row g-3 mt-3">
    <div class="col-md-6">
            <label for="tip" class="form-label">Tip</label>
            <input type="text" class="form-control" id="tip" name="tip" value="<?= $format['tip'] ?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="koeficijent" class="form-label">Koeficijent</label>
            <input type="number" step="0.01" class="form-control" id="koeficijent" name="koeficijent" value="<?= $format['koeficijent'] ?>" disabled>
        </div>
        <div class="col-12 d-flex mt-4 justify-content-between">
            <a href="/formats" class="btn btn-primary mb-3">Povratak</a>
            <a href="/formats/edit?id=<?= $format['id'] ?>" class="btn btn-info mb-3">Uredi</a>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>