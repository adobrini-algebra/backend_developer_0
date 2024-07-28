<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1">
    <div class="title flex-between">
        <h2>Nova Posudba</h2>
        <div class="action-buttons">
        </div>
    </div>
    
    <hr>

    <form class="row g-3 mt-3" action="/rentals/store" method="POST">

        <?php include base_path('views/rentals/partials/create-form.php') ?>
        
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Dodaj</button>
        </div>
    </form>

    <div class="my-5"></div>

    <h2>Aktivne Posudbe</h2>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Posudba</th>
                <th>Clan</th>
                <th>Film</th>
                <th>Cijena</th>
                <th class="table-action-col">Vrati</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rentals as $rental): ?>
                <tr>
                    <td><?= $rental['id'] ?></td>
                    <td>
                        <a href="/rentals/show?pid=<?= $rental['id'] ?>&kid=<?= $rental['kopija_id'] ?>" class="btn btn-light btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Prikazi posudbu"><i class="bi bi-credit-card"></i></a>
                        <?= $rental['datum_posudbe'] ?>
                    </td>
                    <td>
                        <a href="/members/show?id=<?= $rental['clan_id'] ?>" class="btn btn-light btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Prikazi clana"><i class="bi bi-person-circle"></i></a>
                        <?= $rental['clanski_broj'] ?> - <?= $rental['ime'] ?> <?= $rental['prezime'] ?>
                    </td>
                    <td>
                        <a href="/movies/show?id=<?= $rental['film_id'] ?>" class="btn btn-light btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Prikazi film"><i class="bi bi-camera-reels"></i></a>
                        <?= $rental['medij'] ?> - <?= mb_strimwidth($rental['naslov'], 0, 40, '...') ?>
                    </td>
                    <td>
                        <a href="/prices/show?id=<?= $rental['cjenik_id'] ?>" class="btn btn-light btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Prikazi cjenik"><i class="bi bi-currency-euro"></i></a>
                        <?= formatPrice($rental['cijena'] * $rental['koeficijent']) ?> - <?= $rental['tip_filma'] ?>
                    </td>
                    <td>
                        <form action="/rentals/return" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="pid" value="<?= $rental['id'] ?>">
                            <input type="hidden" name="kid" value="<?= $rental['kopija_id'] ?>">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Oznaci vraceno"><i class="bi bi-arrow-counterclockwise"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>