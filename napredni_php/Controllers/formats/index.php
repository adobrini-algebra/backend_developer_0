<?php

use Core\Database;
use Core\Session;

$db = Database::get();

$formats = $db->query("SELECT * from mediji ORDER BY id")->all();

$pageTitle = 'Mediji';

$message = Session::all('message');
Session::unflash();

require base_path('views/formats/index.view.php');