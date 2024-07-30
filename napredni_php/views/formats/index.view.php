<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1">
    <div class="title flex-between">
        <h1>Medij</h1>
        <div class="action-buttons">
            <a href="/formats/create" type="submit" class="btn btn-primary">Dodaj novi</a>
        </div>
    </div>

    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tip</th>
                <th>Koeficijent</th>
                <th class="table-action-col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formats as $format): ?>
                <tr>
                    <td><?= $format['id'] ?></td>
                    <td>
                        <a href="/formats/show?id=<?= $format['id'] ?>">
                            <?= $format['tip'] ?>
                        </a>
                    </td>
                    <td><?= $format['koeficijent'] ?></td>
                    <td>
                        <a href="/formats/edit?id=<?= $format['id'] ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Uredi medij"><i class="bi bi-pencil"></i></a>
                        <form action="/formats/destroy" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $format['id'] ?>">
                            <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Obrisi medij"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>