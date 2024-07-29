<?php

use Core\Database;
use Core\Session;

$db = Database::get();

$genres = $db->query("SELECT * FROM zanrovi ORDER BY id")->all();
$prices = $db->query("SELECT * FROM cjenik ORDER BY id")->all();
$formats = $db->query("SELECT * FROM mediji ORDER BY id")->all();

$errors = Session::all('errors');
Session::unflash();

require base_path('views/movies/create.view.php');