<?php

use Core\Database;
use Core\Session;
use Core\ResourceInUseException;

if (!isset($_POST['id'] ) || !isset($_POST['_method']) || $_POST['_method'] !== 'DELETE') {
    abort();
}

$db = Database::get();

$price = $db->query("SELECT * from cjenik WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

$sql = "DELETE from cjenik WHERE id = :id";

try {
    $db->query($sql, ['id' => $_POST['id']]);
} catch (ResourceInUseException $e) {
    Session::flash('message', [
        'type' => 'danger',
        'message' => "Ne mozete obrisati cijenu {$price['tip_filma']} prije nego obrisete sve filmove koji imaju istu cijenu."
    ]);
    goBack();
}

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno obrisana cijena {$price['tip_filma']}"
]);

redirect('prices');
