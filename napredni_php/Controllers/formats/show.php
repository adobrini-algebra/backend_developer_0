<?php

use Core\Database;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$format = $db->query("SELECT * from mediji WHERE id = :id", ['id' => $_GET['id']])->findOrFail();

$pageTitle = 'Medij';

require base_path('views/formats/show.view.php');

