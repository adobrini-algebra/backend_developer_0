<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$moviesSql = "SELECT 
        f.*,
        m.tip AS medij,
        COUNT(k.id) AS kolicina
    FROM filmovi f
    LEFT JOIN kopija k ON f.id = k.film_id
    LEFT JOIN mediji m ON m.id = k.medij_id
    WHERE f.id = :id
    GROUP BY m.id";

$movies = $db->query($moviesSql, ['id' => $_GET['id']])->all();

if (empty($movies)) {
    abort();
}

$quantities = [];
foreach ($movies as $m) {
    $quantities[$m['medij']] = $m['kolicina'];
    $movie = $m;
}
$movie['quantities'] = $quantities;

$copies = $db->query("SELECT k.*, m.tip AS medij from kopija k JOIN mediji m ON m.id = k.medij_id WHERE film_id = :id", ['id' => $movie['id']])->all();

$genres = $db->query("SELECT * FROM zanrovi ORDER BY id")->all();
$prices = $db->query("SELECT * FROM cjenik ORDER BY id")->all();
$formats = $db->query("SELECT * FROM mediji ORDER BY id")->all();

$errors = Session::all('errors');
Session::unflash();

$pageTitle = 'Film';
require base_path('views/movies/show.view.php');