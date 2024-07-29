<?php

use Core\Database;
use Core\Session;
use Core\Validator;

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    dd('Unsupported method!');
}

$rules = [
    'movie' => ['required', 'numeric', 'exists:filmovi,id'],
    'member' => ['required', 'numeric','exists:clanovi,id'],
    'format' => ['required', 'numeric', 'exists:mediji,id'],
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();
$db = Database::get();

$copy = $db->query("SELECT id from kopija WHERE dostupan = 1 AND film_id = :movie AND medij_id = :format", [
    'movie' => $data['movie'],
    'format' => $data['format']
])->find();

if (!$copy) {
    Session::flash('message', [
        'type' => 'danger',
        'message' => "Odabrani film trenutno nije dostupan"
    ]);
    goBack();
}

try {
    $db->connection()->beginTransaction();

    $rentalSql = "INSERT INTO posudba (datum_posudbe, clan_id) VALUES (:dp, :clan)";
    $db->query($rentalSql, [
        'dp' => date("Y-m-d"),
        'clan' => $data['member']
    ]);

    $rentalId = $db->lastId();

    if (!$rentalId) {
        throw new Exception("Failed to retrieve last inserted rentalId.");
    }

    $copySql = "INSERT INTO posudba_kopija (posudba_id, kopija_id) VALUES (:posudba, :kopija)";
    $db->query($copySql, [
        'posudba' => $rentalId,
        'kopija' => $copy['id']
    ]);

    $db->query("UPDATE kopija SET dostupan = 0 WHERE id = :id", ['id' => $copy['id']]);

    $db->connection()->commit();
} catch (\Exception $e) {
    $db->connection()->rollBack();
    throw $e;
}

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno kreirana posudba."
]);

goBack();
