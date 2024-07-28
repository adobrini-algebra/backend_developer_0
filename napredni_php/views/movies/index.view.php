<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1">
    <div class="title flex-between">
        <h1>Filmovi</h1>
        <div class="action-buttons">
            <a href="/movies/create" type="submit" class="btn btn-primary">Dodaj novi</a>
        </div>
    </div>

    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Naslov</th>
                <th>Medij (broj kopija)</th>
                <th>Godina</th>
                <th>Žanr</th>
                <th>Tip Filma</th>
                <th class="table-action-col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><?= $movie['id'] ?></td>
                    <td><?= $movie['naslov'] ?></td>
                    <td><?php foreach ($movie['formats'] as $formatId => $format): ?>
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#rentalCreateModal"
                                data-bs-format-id="<?= $formatId ?>"
                                data-bs-format-name="<?= $format['tip'] ?>"
                                data-bs-movie-id="<?= $movie['id'] ?>"
                                data-bs-movie-title="<?= $movie['naslov'] ?>">
                            <i class="bi bi-<?= $format['icon'] ?> me-1"></i>
                            <?= $format['tip'] ?> (<?= $format['kolicina'] ?>)
                        </button>
                    <?php endforeach ?></td>
                    <td><?= $movie['godina'] ?></td>
                    <td><?= $movie['zanr'] ?></td>
                    <td><?= $movie['tip_filma'] ?></td>
                    <td>
                        <a href="#" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Movie"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Movie"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>

<div class="modal fade" id="rentalCreateModal" tabindex="-1" aria-labelledby="rentalCreateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <form action="/rentals/store" method="POST">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="rentalCreateModalLabel">Napravite novu posudbu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="member" class="form-label ps-1">Clan</label>
                    <select class="form-select <?= isset($errors['member']) ? 'is-invalid' : '' ?>" name="member" id="member">
                        <option selected>Odaberite Clana</option>
                        <?php foreach ($members as $member): ?>
                            <option value="<?= $member['id'] ?>"><?= $member['clanski_broj'] ?> - <?= $member['ime'] ?> <?= $member['prezime'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <span class="invalid-feedback"><?= $errors['member'] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="movie" class="col-form-label">Film</label>
                    <input type="text" class="form-control" id="movie-title" readonly>
                    <input type="hidden" class="form-control" id="movie" name="movie" readonly>
                </div>
                <div class="mb-3">
                    <label for="format" class="col-form-label">Medij</label>
                    <input type="text" class="form-control" id="format-name" readonly>
                    <input type="hidden" class="form-control" id="format" name="format" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                <button type="submit" class="btn btn-primary">Spremi posudbu</button>
            </div>
        </form>
    </div>
  </div>
</div>

<?php include_once base_path('views/partials/footer.php'); ?>