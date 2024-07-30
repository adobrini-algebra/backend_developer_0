<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <h1><?= $genre['ime'] ?></h1>
    <hr>
    <form class="row g-3 mt-3" action="/genre-create.php" method="POST">
        <div class="col-md-2">
            <label for="zanr" class="mt-1">Id Zanra:</label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" id="zanr" name="zanr" value="<?= $genre['id'] ?>" disabled>
        </div>
        <div class="col-md-2">
            <label for="zanr" class="mt-1">Naziv Zanra:</label>
        </div>
        <div class="col-md-10">
            <input type="text" class="form-control" id="zanr" name="zanr" value="<?= $genre['ime'] ?>" disabled>
        </div>
        <div class="col-md-12 mt-4 d-flex justify-content-between">
            <a href="/genres" class="btn btn-primary mb-3">Povratak</a>
            <a href="/genres/edit?id=<?= $genre['id'] ?>" class="btn btn-info mb-3">Uredi</a>
        </div>
    </form>
    
    <h2 class="mt-5">Filmovi u zanru <?= $genre['ime'] ?></h2>
    <hr class="mb-4">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Naslov</th>
                <th>Godina</th>
                <th>Tip Filma</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><?= $movie['id'] ?></td>
                    <td>
                        <a href="/movies/show?id=<?= $movie['id'] ?>"><?= $movie['naslov'] ?></a>
                    </td>
                    <td><?= $movie['godina'] ?></td>
                    <td><?= $movie['tip_filma'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>
