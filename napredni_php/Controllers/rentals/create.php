<?php

use Core\Database;
use Core\Session;

$pageTitle = 'Kreiraj Posudbu';

$db = Database::get();

$members = $db->query("SELECT * from clanovi ORDER BY id")->all();
$movies = $db->query("SELECT * from filmovi ORDER BY id")->all();
$formats = $db->query("SELECT * from mediji ORDER BY id")->all();

$errors = Session::all('errors');
$message = Session::all('message');
Session::unflash();

require base_path('views/rentals/create.view.php');
