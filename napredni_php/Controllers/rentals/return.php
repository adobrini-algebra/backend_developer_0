<?php

use Core\Database;
use Core\Session;

if ((!isset($_POST['pid']) && !isset($_POST['kid'])) || !isset($_POST['_method']) || $_POST['_method'] !== 'DELETE') {
    abort();
}

$db = Database::get();

$rental = $db->query('SELECT * from posudba WHERE id = :id', ['id' => $_POST['pid']])->findOrFail();
$copy = $db->query('SELECT * from kopija WHERE id = :id', ['id' => $_POST['kid']])->findOrFail();

$db->connection()->beginTransaction();

$db->query("UPDATE kopija SET dostupan = 1 WHERE id = :id", ['id' => $copy['id']]);
$db->query("UPDATE posudba SET datum_povrata = :dpovrat, updated_at = :updated WHERE id = :id", [
    'id' => $rental['id'],
    'dpovrat' => date("Y-m-d"),
    'updated' => date("Y-m-d H:i:s")
]);

$db->connection()->commit();

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno vracena posudba {$rental['id']}."
]);

goBack();
