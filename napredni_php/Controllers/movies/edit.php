<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$movie = $db->query("SELECT * from filmovi WHERE id = :id", ['id' => $_GET['id']])->findOrFail();

$copies = $db->query("SELECT k.*, m.tip AS medij from kopija k JOIN mediji m ON m.id = k.medij_id WHERE film_id = :id", ['id' => $movie['id']])->all();
$genres = $db->query("SELECT * FROM zanrovi ORDER BY id")->all();
$prices = $db->query("SELECT * FROM cjenik ORDER BY id")->all();
$formats = $db->query("SELECT * FROM mediji ORDER BY id")->all();

$errors = Session::all('errors');
Session::unflash();

$pageTitle = 'Uredi film';
require base_path('views/movies/edit.view.php');