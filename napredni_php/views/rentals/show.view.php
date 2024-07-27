<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Posudba <?= $rental['naslov'] ?> na <?= $rental['medij'] ?></h1>
        <div class="action-buttons">
            <h2>
                <span class="badge text-bg-<?= $rental['returned'] ? 'success' : 'danger' ?>"><?= $rental['returned'] ? 'Vracen' : 'U posudbi' ?></span>
            </h2>
        </div>
    </div>
    <hr>
    <table class="table text-center">
        <tr>
            <th>Dani posudbe</th>
            <th>Cijena za prvi dan</th>
            <th>Dani kasnjenja</th>
            <th>Zakasnina po danu</th>
            <th>Zakasnina ukupno</th>
            <th>Ukupno dugovanje</th>
        </tr>
        <tr>
            <td><?= $rental['total_days'] ?></td>
            <td><?= $rental['price'] ?></td>
            <td><?= $rental['late_days'] ?></td>
            <td><?= $rental['late_fee'] ?></td>
            <td><?= $rental['late_fee_formatted'] ?></td>
            <td><?= $rental['total_price'] ?></td>
        </tr>
    </table>
    <form class="row g-3 mt-3">
        <div class="col-md-4">
            <label for="adresa" class="form-label">Datum Posudbe</label>
            <input type="text" class="form-control" id="adresa" name="adresa" value="<?= $rental['datum_posudbe'] ?>" disabled>
        </div>
        <div class="col-md-4">
            <label for="adresa" class="form-label">Datum Povrata</label>
            <input type="text" class="form-control" id="adresa" name="adresa" value="<?= $rental['datum_povrata'] ?>" disabled>
        </div>
        <div class="col-md-4">
            <label for="adresa" class="form-label">Vrijeme zadnje promjene</label>
            <input type="text" class="form-control" id="adresa" name="adresa" value="<?= $rental['updated_at'] ?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="prezime" class="form-label">Film</label>
            <input type="text" class="form-control" id="prezime" name="prezime" value="<?= $rental['naslov'] ?> - <?= $rental['barcode'] ?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="telefon" class="form-label">Medij</label>
            <input type="text" class="form-control" id="telefon" name="telefon" value="<?= $rental['medij'] ?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="ime" class="form-label">Clan</label>
            <input type="text" class="form-control" id="ime" name="ime" value="<?= $rental['clanski_broj'] ?> - <?= $rental['ime'] ?> <?= $rental['prezime'] ?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="telefon" class="form-label">Cijena</label>
            <input type="text" class="form-control" id="telefon" name="telefon" value="<?= $rental['price'] ?> - <?= $rental['tip_filma'] ?>" disabled>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <a href="/rentals" class="btn btn-primary mb-3">Povratak</a>
            <a href="/rentals/edit?pid=<?= $rental['id'] ?>&kid=<?= $rental['kopija_id'] ?>" class="btn btn-info mb-3">Uredi</a>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>