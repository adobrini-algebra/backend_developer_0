<?php

use Core\Validator;

 include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Dodaj novi Film</h1>
        <div class="action-buttons">
        </div>
    </div>
    <hr>
    <form class="row g-3 mt-3" action="/movies/store" method="POST">
        <div class="col-md-6">
            <label for="naslov" class="form-label">Naslov</label>
            <input type="text" class="form-control <?= validationClass($errors, 'naslov') ?>" id="naslov" name="naslov" placeholder="Naslov">
            <?= validationFeedback($errors, 'naslov') ?>
        </div>
        <div class="col-md-6">
            <label for="godina" class="form-label">Godina</label>
            <input type="text" class="form-control <?= validationClass($errors, 'godina') ?>" id="godina" name="godina" placeholder="Godina">
            <?= validationFeedback($errors, 'godina') ?>
        </div>
        <div class="col-md-6">
            <label for="zanr" class="form-label ps-1">Žanr</label>
            <select class="form-select <?= validationClass($errors, 'zanr') ?>" aria-label="Default select example" name="zanr">
                <option selected>Odaberite zanr</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?= $genre['id'] ?>"><?= $genre['ime'] ?></option>
                <?php endforeach ?>
            </select>
            <?= validationFeedback($errors, 'zanr') ?>
        </div>
        <div class="col-md-6">
            <label for="cijena" class="form-label ps-1">Cjenik</label>
            <select class="form-select <?= validationClass($errors, 'cijena') ?>" aria-label="Default select example" name="cijena">
                <option selected>Odaberite cijenu</option>
                <?php foreach ($prices as $priceItem): ?>
                    <option value="<?= $priceItem['id'] ?>"><?= $priceItem['tip_filma'] . " - Cijena " .  $priceItem['cijena'] . " EUR - Zakasnina " . $priceItem['zakasnina_po_danu'] . " EUR"?></option>
                <?php endforeach ?>
            </select>
            <?= validationFeedback($errors, 'cijena') ?>
        </div>
        <?php foreach ($formats as $format): ?>
            <div class="col-md-<?= 12 / count($formats) ?>">
                <label for="<?= $format['tip'] ?>" class="form-label"><?= $format['tip'] ?> kolicina</label>
                <input type="number" class="form-control <?= validationClass($errors, $format['tip']) ?>" id="<?= $format['tip'] ?>" name="<?= $format['tip'] ?>" placeholder="<?= $format['tip'] ?> kolicina">
                <?= validationFeedback($errors, $format['tip'] ) ?>
            </div>
        <?php endforeach ?>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary mb-3">Spremi</button>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>