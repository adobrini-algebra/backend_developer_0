<div class="col-md-5">
    <select class="form-select <?= validationClass($errors, 'movie') ?>" name="movie" id="movie">
        <option selected>Odaberite Film</option>
        <?php foreach ($movies as $movie): ?>
            <option value="<?= $movie['id'] ?>"><?= $movie['godina'] ?> - <?= $movie['naslov'] ?></option>
        <?php endforeach ?>
    </select>
    <?= validationFeedback($errors, 'movie') ?>
</div>
<div class="col-md-2">
    <select class="form-select <?= validationClass($errors, 'format') ?>" name="format" id="format">
        <option selected>Odaberite Medij</option>
        <?php foreach ($formats as $format): ?>
            <option value="<?= $format['id'] ?>"><?= $format['tip'] ?></option>
        <?php endforeach ?>
    </select>
    <?= validationFeedback($errors, 'format') ?>
</div>
<div class="col-md-4">
    <select class="form-select <?= validationClass($errors, 'member') ?>" name="member" id="member">
        <option selected>Odaberite Clana</option>
        <?php foreach ($members as $member): ?>
            <option value="<?= $member['id'] ?>"><?= $member['clanski_broj'] ?> - <?= $member['ime'] ?> <?= $member['prezime'] ?></option>
        <?php endforeach ?>
    </select>
    <?= validationFeedback($errors, 'member') ?>
</div>