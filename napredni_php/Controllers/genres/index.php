<?php

use Core\Database;
use Core\Session;

$db = Database::get();

$sql = "SELECT * from zanrovi ORDER BY id";
$genres = $db->query($sql)->all();


$errors = Session::get('errors');
$pageTitle = 'Zanrovi';
require base_path('views/genres/index.view.php');