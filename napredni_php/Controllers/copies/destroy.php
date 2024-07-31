<?php

use Core\Database;
use Core\Session;
use Core\ResourceInUseException;

if (!isset($_POST['id']) && !isset($_POST['_method']) || $_POST['_method'] !== 'DELETE') {
    abort();
}

$db = Database::get();

$copy = $db->query('SELECT * from kopija WHERE id = :id', ['id' => $_POST['id']])->findOrFail();

try {
    $db->query("DELETE from kopija WHERE id = :id", ['id' => $_POST['id']]);
} catch (ResourceInUseException $e) {
    Session::flash('message', [
        'type' => 'danger',
        'message' => "Ne mozete obrisati kopiju {$copy['barcode']} prije nego je ista vracena"
    ]);
    goBack();
}

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno obrisana kopija {$copy['barcode']}"
]);

goBack();
