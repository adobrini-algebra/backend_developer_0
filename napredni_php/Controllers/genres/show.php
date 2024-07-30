<?php

use Core\Database;

if (!isset($_GET['id'])) {
    abort();
}

$db = Database::get();

$genre = $db->query("SELECT * from zanrovi WHERE id = :id", ['id' => $_GET['id']])->findOrFail();

$movies = $db->query("SELECT f.*, cjenik.tip_filma from filmovi f JOIN cjenik ON f.cjenik_id = cjenik.id WHERE zanr_id = :id", ['id' => $genre['id']])->all();

require base_path('views/genres/show.view.php');
