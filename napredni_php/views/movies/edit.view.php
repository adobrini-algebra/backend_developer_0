<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Uredi film <?= $movie['naslov'] ?></h1>
        <div class="action-buttons">
        </div>
    </div>
    <hr>
    <form class="row g-3 mt-3" action="/movies/update" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $movie['id'] ?>">
        <div class="col-md-6">
            <label for="naslov" class="form-label">Naslov</label>
            <input type="text" class="form-control <?= validationClass($errors, 'naslov') ?>" id="naslov" name="naslov" value="<?= $movie['naslov'] ?>">
            <?= validationFeedback($errors, 'naslov') ?>
        </div>
        <div class="col-md-6">
            <label for="godina" class="form-label">Godina</label>
            <input type="text" class="form-control <?= validationClass($errors, 'godina') ?>" id="godina" name="godina" value="<?= $movie['godina'] ?>">
            <?= validationFeedback($errors, 'godina') ?>
        </div>
        <div class="col-md-6">
            <label for="zanr" class="form-label ps-1">Žanr</label>
            <select class="form-select <?= validationClass($errors, 'zanr') ?>" aria-label="Default select example" name="zanr">
                <option selected>Odaberite zanr</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?= $genre['id'] ?>" <?= $genre['id'] === $movie['zanr_id'] ? 'selected' : '' ?>><?= $genre['ime'] ?></option>
                <?php endforeach ?>
            </select>
            <?= validationFeedback($errors, 'zanr') ?>
        </div>
        <div class="col-md-6">
            <label for="cijena" class="form-label ps-1">Cjenik</label>
            <select class="form-select  <?= validationClass($errors, 'cijena') ?>" aria-label="Default select example" name="cijena">
                <option selected>Odaberite cijenu</option>
                <?php foreach ($prices as $priceItem): ?>
                    <option value="<?= $priceItem['id'] ?>" <?= $priceItem['id'] === $movie['cjenik_id'] ? 'selected' : '' ?>><?= $priceItem['tip_filma'] . " - Cijena " .  $priceItem['cijena'] . " EUR - Zakasnina " . $priceItem['zakasnina_po_danu'] . " EUR"?></option>
                <?php endforeach ?>
            </select>
            <?= validationFeedback($errors, 'cijena') ?>
        </div>
        <?php foreach ($formats as $format): ?>
            <div class="col-md-<?= 12 / count($formats) ?>">
                <label for="<?= $format['tip'] ?>" class="form-label">Dodajte <?= $format['tip'] ?> kopije</label>
                <input type="number" class="form-control <?= validationClass($errors, $format['tip']) ?>" id="<?= $format['tip'] ?>" name="<?= $format['tip'] ?>">
                <?= validationFeedback($errors, $format['tip']) ?>
            </div>
        <?php endforeach ?>
        <div class="col-12 d-flex justify-content-between">
            <a href="/movies" class="btn btn-primary mb-3">Povratak</a>
            <button type="submit" class="btn btn-success mb-3">Spremi</button>
        </div>
    </form>

    <hr class="my-5">

    <?php if (empty($copies)): ?>
        <h4>Za ovaj film nema kreiranih kopija</h4>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Barkod</th>
                    <th>Dostupnost</th>
                    <th>Medij</th>
                    <th class="table-action-col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($copies as $copy): ?>
                    <tr>
                        <td><?= $copy['id'] ?></td>
                        <td>
                            <a href="/copys/show?id=<?= $copy['id'] ?>"><?= $copy['barcode'] ?></a>
                        </td>
                        <td><?= $copy['dostupan'] ? '<span class="badge text-bg-success">Dostupan</span>' : '<span class="badge text-bg-danger">Posudjen</span>' ?></td>
                        <td><?= $copy['medij'] ?></td>
                        <td>
                            <a href="/copys/edit?id=<?= $copy['id'] ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Uredi Kopiju"><i class="bi bi-pencil"></i></a>
                            <form action="/copys/destroy" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $copy['id'] ?>">
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Obrisi Kopiju"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>