<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$movie = $db->query("SELECT * from filmovi WHERE id = :id", ['id' => $_GET['id']])->findOrFail();

$copiesSql = "SELECT
    k.*,
    pk.posudba_id,
    m.tip AS medij
from kopija k
    JOIN mediji m ON m.id = k.medij_id
    LEFT JOIN posudba_kopija pk ON k.id = pk.kopija_id
WHERE film_id = :id
ORDER BY m.id";

$copies = $db->query($copiesSql, ['id' => $movie['id']])->all();

$genres = $db->query("SELECT * FROM zanrovi ORDER BY id")->all();
$prices = $db->query("SELECT * FROM cjenik ORDER BY id")->all();
$formats = $db->query("SELECT * FROM mediji ORDER BY id")->all();

$errors = Session::get('errors');
$pageTitle = 'Uredi film';
require base_path('views/movies/edit.view.php');