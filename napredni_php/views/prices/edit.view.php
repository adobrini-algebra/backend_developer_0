<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Uredi <?= $price['tip_filma'] ?> cijenu</h1>
        <div class="action-buttons">
        </div>
    </div>
    <hr>
    <form class="row g-3 mt-3" method="POST" action="/prices/update">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $price['id'] ?>">
        <div class="col-md-4">
            <label for="tip_filma" class="form-label">Tip filma</label>
            <input type="text" class="form-control <?= validationClass($errors, 'tip_filma') ?>" id="tip_filma" name="tip_filma" value="<?= $price['tip_filma'] ?>">
            <?= validationFeedback($errors, 'tip_filma') ?>
        </div>
        <div class="col-md-4">
            <label for="cijena" class="form-label">Cijena po danu</label>
            <input type="number" step="0.01" class="form-control <?= validationClass($errors, 'cijena') ?>" id="cijena" name="cijena" value="<?= $price['cijena'] ?>">
            <?= validationFeedback($errors, 'cijena') ?>
        </div>
        <div class="col-md-4">
            <label for="zakasnina" class="form-label">Zakasnina po danu</label>
            <input type="number" step="0.01" class="form-control <?= validationClass($errors, 'zakasnina') ?>" id="zakasnina" name="zakasnina" value="<?= $price['zakasnina_po_danu'] ?>">
            <?= validationFeedback($errors, 'zakasnina') ?>
        </div>
        <div class="col-12 d-flex mt-4 justify-content-between">
            <a href="/prices" class="btn btn-primary mb-3">Povratak</a>
            <button type="submit" class="btn btn-success mb-3">Spremi</button>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>