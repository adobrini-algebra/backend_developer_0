<?php

use Core\Database;
use Core\Session;

if (!isset($_POST['id']) && !isset($_POST['_method']) || $_POST['_method'] !== 'DELETE') {
    abort();
}

$db = Database::get();

$movie = $db->query('SELECT * from filmovi WHERE id = :id', ['id' => $_POST['id']])->findOrFail();

$db->query("DELETE from filmovi WHERE id = :id", ['id' => $_POST['id']]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno obrisan film {$movie['naslov']} i sve povezane kopije."
]);

redirect('movies');
