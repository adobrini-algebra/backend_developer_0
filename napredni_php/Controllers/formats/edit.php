<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$format = $db->query("SELECT * from mediji WHERE id = :id", ['id' => $_GET['id']])->findOrFail();

$pageTitle = "Uredi Medij";

$errors = Session::all('errors');
Session::unflash();

require base_path('views/formats/edit.view.php');