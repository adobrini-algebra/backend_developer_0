<?php include_once base_path('views/partials/header.php'); ?>

<main class="container my-3 d-flex flex-column flex-grow-1 vh-100">
    <div class="title flex-between">
        <h1>Uredi <?= $member['ime'] ?> <?= $member['prezime'] ?></h1>
        <div class="action-buttons">
        </div>
    </div>
    <hr>
    <form class="row g-3 mt-3" action="/members/update" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" value="<?= $member['id'] ?>">
        <div class="col-md-6">
            <label for="ime" class="form-label">Ime</label>
            <input type="text" class="form-control <?= isset($errors['ime']) ? 'is-invalid' : '' ?>" id="ime" name="ime" value="<?= $member['ime'] ?>" required>
            <span class="invalid-feedback"><?= $errors['ime'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
            <label for="prezime" class="form-label">Prezime</label>
            <input type="text" class="form-control <?= isset($errors['prezime']) ? 'is-invalid' : '' ?>" id="prezime" name="prezime" value="<?= $member['prezime'] ?>" required>
            <span class="invalid-feedback"><?= $errors['prezime'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
            <label for="adresa" class="form-label">Adresa</label>
            <input type="text" class="form-control <?= isset($errors['adresa']) ? 'is-invalid' : '' ?>" id="adresa" name="adresa" value="<?= $member['adresa'] ?>">
            <span class="invalid-feedback"><?= $errors['adresa'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
            <label for="telefon" class="form-label">Telefon</label>
            <input type="text" class="form-control <?= isset($errors['telefon']) ? 'is-invalid' : '' ?>" id="telefon" name="telefon" value="<?= $member['telefon'] ?>">
            <span class="invalid-feedback"><?= $errors['telefon'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $member['email'] ?>" required>
            <span class="invalid-feedback"><?= $errors['email'] ?? '' ?></span>
        </div>
        <div class="col-md-6">
            <label for="clanski_broj" class="form-label">Clanski broj</label>
            <input type="text" class="form-control <?= isset($errors['clanski_broj']) ? 'is-invalid' : '' ?>" id="clanski_broj" name="clanski_broj" value="<?= $member['clanski_broj'] ?>" required>
            <span class="invalid-feedback"><?= $errors['clanski_broj'] ?? '' ?></span>
        </div>
        <div class="col-12 d-flex justify-content-between">
            <a href="/members" class="btn btn-primary mb-3">Povratak</a>
            <button type="submit" class="btn btn-success mb-3">Spremi</button>
        </div>
    </form>
</main>

<?php include_once base_path('views/partials/footer.php'); ?>