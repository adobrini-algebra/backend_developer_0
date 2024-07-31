<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$genre = $db->query('SELECT * FROM zanrovi WHERE id = ?', [$_GET['id']])->findOrFail();

$errors = Session::get('errors');
$pageTitle = 'Zanrovi';
require base_path('views/genres/edit.view.php');
