<?php

use Core\Database;
use Core\Session;
use Core\ResourceInUseException;

if (!isset($_POST['id']) || !isset($_POST['_method']) || $_POST['_method'] !== 'DELETE') {
    abort();
}

$db = Database::get();

$genre = $db->query('SELECT * FROM zanrovi WHERE id = ?', [$_POST['id']])->findOrFail();

try {
    $db->query('DELETE FROM zanrovi WHERE id = ?', [$genre['id']]);
} catch (ResourceInUseException $e) {
    Session::flash('message', [
        'type' => 'danger',
        'message' => "Ne mozete obrisati Zanr {$genre['ime']} prije nego obrisete sve filmove koji pripadaju Zanru."
    ]);
    goBack();
}

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno obrisan Zanr {$genre['ime']}."
]);

redirect('genres');

