<?php

use Core\Database;
use Core\Session;
use Core\ResourceInUseException;

if (!isset($_POST['id'] ) || !isset($_POST['_method']) || $_POST['_method'] !== 'DELETE') {
    abort();
}

$db = Database::get();

$format = $db->query("SELECT * from mediji WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

try {
    $db->query("DELETE from mediji WHERE id = :id", ['id' => $_POST['id']]);
} catch (ResourceInUseException $e) {
    Session::flash('message', [
        'type' => 'danger',
        'message' => "Ne mozete obrisati medij {$format['tip']} prije nego obrisete sve filmove koji koriste istu cijenu."
    ]);
    goBack();
}

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno obrisan medij {$format['tip']}"
]);

redirect('formats');
