<?php

use Core\Database;
use Core\Session;

$db = Database::get();

$sql = "SELECT * from zanrovi ORDER BY id";
$genres = $db->query($sql)->all();


$errors = Session::all('errors');
$message = Session::all('message');
Session::unflash();

$pageTitle = 'Zanrovi';

require '../views/genres/index.view.php';