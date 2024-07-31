<?php

use Core\Database;

$db = Database::get();

$formats = $db->query("SELECT * from mediji ORDER BY id")->all();

$pageTitle = 'Mediji';
require base_path('views/formats/index.view.php');