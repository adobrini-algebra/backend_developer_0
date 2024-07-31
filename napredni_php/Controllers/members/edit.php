<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$sql = "SELECT * from clanovi WHERE id = :id";
$member = $db->query($sql, ['id' => $_GET['id']])->findOrFail();

$pageTitle = "Uredi Clana";
$errors = Session::get('errors');
require base_path('views/members/edit.view.php');