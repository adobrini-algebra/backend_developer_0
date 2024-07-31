<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$price = $db->query("SELECT * from cjenik WHERE id = :id", ['id' => $_GET['id']])->findOrFail();

$pageTitle = "Uredi Cijenu";
$errors = Session::get('errors');
require base_path('views/prices/edit.view.php');