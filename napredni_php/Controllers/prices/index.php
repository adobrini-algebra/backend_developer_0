<?php

use Core\Database;
use Core\Session;

$db = Database::get();

$prices = $db->query("SELECT * from cjenik ORDER BY id")->all();

$pageTitle = 'Cjenik';

$message = Session::all('message');
Session::unflash();

require base_path('views/prices/index.view.php');