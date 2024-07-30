<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Cijena za <?= $price['tip_filma'] ?> film</h1>
        <div class="action-buttons">
        </div>
    </div>
    <hr>
    <form class="row g-3 mt-3">
        <div class="col-md-4">
            <label for="tip" class="form-label">Tip filma</label>
            <input type="text" class="form-control" id="tip" name="tip" value="<?= $price['tip_filma'] ?>" disabled>
        </div>
        <div class="col-md-4">
            <label for="cijena" class="form-label">Cijena po danu</label>
            <input type="text" class="form-control" id="cijena" name="cijena" value="<?= formatPrice($price['cijena']) ?>" disabled>
        </div>
        <div class="col-md-4">
            <label for="zakasnina" class="form-label">Zakasnina po danu</label>
            <input type="text" class="form-control" id="zakasnina" name="zakasnina" value="<?= formatPrice($price['zakasnina_po_danu']) ?>" disabled>
        </div>
        <div class="col-12 d-flex mt-4 justify-content-between">
            <a href="/prices" class="btn btn-primary mb-3">Povratak</a>
            <a href="/prices/edit?id=<?= $price['id'] ?>" class="btn btn-info mb-3">Uredi</a>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>