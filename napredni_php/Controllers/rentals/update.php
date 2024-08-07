<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if ((!isset($_POST['pid']) && !isset($_POST['kid'])) || !isset($_POST['_method']) || $_POST['_method'] !== 'PATCH') {
    abort();
}

$db = Database::get();

$rules = [
    'movie' => ['required', 'numeric', 'exists:filmovi,id'],
    'member' => ['required', 'numeric','exists:clanovi,id'],
    'format' => ['required', 'numeric', 'exists:mediji,id'],
    'datum_posudbe' => ['required', 'date'],
    'datum_povrata' => ['date']
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();

$oldCopy = $db->query("SELECT id from kopija WHERE id = :kid", ['kid' => $_POST['kid']])->findOrFail();
$newCopy = $db->query("SELECT id, dostupan from kopija WHERE film_id = :movie AND medij_id = :format", [
    'movie' => $data['movie'],
    'format' => $data['format']
])->find();

if ($oldCopy['id'] !== $newCopy['id'] && $newCopy['dostupan'] === 0) {
    Session::flash('message', [
        'type' => 'danger',
        'message' => "Odabrani film trenutno nije dostupan"
    ]);
    goBack();
}

try {
    $db->connection()->beginTransaction();

    $rentalSql = "UPDATE posudba SET datum_posudbe = :dp, datum_povrata = :dpovrat, updated_at = :updated, clan_id = :clan WHERE id = :pid";
    $db->query($rentalSql, [
        'dp' => $data['datum_posudbe'],
        'dpovrat' => $data['datum_povrata'] ?? null,
        'clan' => $data['member'],
        'updated' => date("Y-m-d H:i:s"),
        'pid' => $_POST['pid']
    ]);

    $copySql = "UPDATE posudba_kopija SET kopija_id = :newCopy WHERE posudba_id = :posudba AND kopija_id = :oldCopy";
    $db->query($copySql, [
        'posudba' => $_POST['pid'],
        'newCopy' => $newCopy['id'],
        'oldCopy' => $oldCopy['id']
    ]);

    $db->query("UPDATE kopija SET dostupan = 1 WHERE id = :id", ['id' => $oldCopy['id']]);
    $db->query("UPDATE kopija SET dostupan = 0 WHERE id = :id", ['id' => $newCopy['id']]);


    $db->connection()->commit();
} catch (\Exception $e) {
    $db->connection()->rollBack();
    throw $e;

}

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno uredjena posudba."
]);

redirect('rentals');
