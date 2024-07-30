<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1">
    <div class="title flex-between">
        <h1>Cjenik</h1>
        <div class="action-buttons">
            <a href="/prices/create" type="submit" class="btn btn-primary">Dodaj novi</a>
        </div>
    </div>

    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tip Filma</th>
                <th>Cijena po danu</th>
                <th>Zakasnina po danu</th>
                <th class="table-action-col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prices as $price): ?>
                <tr>
                    <td><?= $price['id'] ?></td>
                    <td>
                        <a href="/prices/show?id=<?= $price['id'] ?>">
                            <?= $price['tip_filma'] ?>
                        </a>
                    </td>
                    <td><?= formatPrice($price['cijena']) ?></td>
                    <td><?= formatPrice($price['zakasnina_po_danu']) ?></td>
                    <td>
                        <a href="/prices/edit?id=<?= $price['id'] ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Uredi cijenu"><i class="bi bi-pencil"></i></a>
                        <form action="/prices/destroy" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $price['id'] ?>">
                            <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Obrisi cijenu"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>