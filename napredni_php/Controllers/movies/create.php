<?php

use Core\Database;
use Core\Session;

$db = Database::get();

$sql = "SELECT * FROM zanrovi ORDER BY id";
$genres = $db->query($sql)->all();

$sql = "SELECT * FROM cjenik ORDER BY id";
$prices = $db->query($sql)->all();

$errors = Session::all('errors');
Session::unflash();

require base_path('views/movies/create.view.php');