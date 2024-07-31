<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Uredi posudbu <?= $rental['naslov'] ?> na <?= $rental['medij'] ?></h1>
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
            <td><?= $rental['price'] ?> - <?= $rental['tip_filma'] ?></td>
            <td><?= $rental['late_days'] ?></td>
            <td><?= $rental['late_fee'] ?></td>
            <td><?= $rental['late_fee_formatted'] ?></td>
            <td><?= $rental['total_price'] ?></td>
        </tr>
    </table>
    <form class="row g-3 mt-3" action="/rentals/update" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="pid" value="<?= $rental['id'] ?>">
        <input type="hidden" name="kid" value="<?= $rental['kopija_id'] ?>">
        <div class="col-md-6">
            <label for="movie" class="form-label ps-1">Film</label>
            <select class="form-select <?= validationClass($errors, 'movie') ?>" name="movie" id="movie">
                <option selected>Odaberite Film</option>
                <?php foreach ($movies as $movie): ?>
                    <option value="<?= $movie['id'] ?>" <?= $movie['id'] === $rental['film_id'] ? 'selected' : '' ?>><?= $movie['godina'] ?> - <?= $movie['naslov'] ?></option>
                <?php endforeach ?>
            </select>
            <?= validationFeedback($errors, 'movie') ?>
        </div>
        <div class="col-md-2">
            <label for="format" class="form-label ps-1">Medij</label>
            <select class="form-select <?= validationClass($errors, 'format') ?>" name="format" id="format">
                <option selected>Odaberite Medij</option>
                <?php foreach ($formats as $format): ?>
                    <option value="<?= $format['id'] ?>" <?= $format['id'] === $rental['medij_id'] ? 'selected' : '' ?>><?= $format['tip'] ?></option>
                <?php endforeach ?>
            </select>
            <?= validationFeedback($errors, 'format') ?>
        </div>
        <div class="col-md-4">
            <label for="member" class="form-label ps-1">Clan</label>
            <select class="form-select <?= validationClass($errors, 'member') ?>" name="member" id="member">
                <option selected>Odaberite Clana</option>
                <?php foreach ($members as $member): ?>
                    <option value="<?= $member['id'] ?>" <?= $member['id'] === $rental['clan_id'] ? 'selected' : '' ?>><?= $member['clanski_broj'] ?> - <?= $member['ime'] ?> <?= $member['prezime'] ?></option>
                <?php endforeach ?>
            </select>
            <?= validationFeedback($errors, 'member') ?>
        </div>
        <div class="col-md-6">
            <label for="datum_posudbe" class="form-label">Datum Posudbe</label>
            <input type="text" class="form-control <?= validationClass($errors, 'datum_posudbe') ?>" id="datum_posudbe" name="datum_posudbe" value="<?= $rental['datum_posudbe'] ?>">
            <?= validationFeedback($errors, 'datum_posudbe') ?>
        </div>
        <div class="col-md-6">
            <label for="datum_povrata" class="form-label">Datum Povrata</label>
            <input type="text" class="form-control <?= validationClass($errors, 'datum_povrata') ?>" id="datum_povrata" name="datum_povrata" value="<?= $rental['datum_povrata'] ?>">
            <?= validationFeedback($errors, 'datum_povrata') ?>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <a href="/rentals" class="btn btn-primary mb-3">Povratak</a>
            <button type="submit" class="btn btn-success mb-3">Spremi</button>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>