<?php

use Core\Database;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$price = $db->query("SELECT * from cjenik WHERE id = :id", ['id' => $_GET['id']])->findOrFail();

$pageTitle = 'Cijena';

require base_path('views/prices/show.view.php');

