<?php

declare(strict_types = 1);

use Core\Database;
use Core\Session;

$db = Database::get();

function icon($medij)
{
    return match ($medij) {
        'DVD' => 'disc-fill text-warning',
        'Blu-ray' => 'disc text-primary',
        'VHS' => 'cassette-fill text-success',
        default => 'disc text-secondary'
    };
}

$sql = "SELECT 
            f.id,
            f.naslov,
            f.godina,
            z.ime AS zanr,
            m.tip AS medij,
            m.id AS m_id,
            c.tip_filma,
            COUNT(CASE WHEN k.dostupan = 1 THEN 1 END) AS kolicina
        FROM
            filmovi f
            LEFT JOIN kopija k ON f.id = k.film_id
            LEFT JOIN zanrovi z ON z.id = f.zanr_id
            LEFT JOIN mediji m ON m.id = k.medij_id
            JOIN cjenik c ON c.id = f.cjenik_id
        GROUP BY f.id, m.id
        ORDER BY f.id";

$results = $db->query($sql)->all();
$movies = [];

foreach ($results as $key => $movie) {
    if (!array_key_exists($movie['id'], $movies)) {
        $movie['formats'][$movie['m_id']]['tip'] = $movie['medij'];
        $movie['formats'][$movie['m_id']]['kolicina'] = $movie['kolicina'];
        $movie['formats'][$movie['m_id']]['icon'] = icon($movie['medij']);
        $movies[$movie['id']] = $movie;
    } else {
        $movies[$movie['id']]['formats'][$movie['m_id']]['tip'] = $movie['medij'];
        $movies[$movie['id']]['formats'][$movie['m_id']]['kolicina'] = $movie['kolicina'];
        $movies[$movie['id']]['formats'][$movie['m_id']]['icon'] = icon($movie['medij']);
    }
}

$members = $db->query("SELECT * from clanovi ORDER BY id")->all();

$errors = Session::get('errors');
$pageTitle = 'Filmovi';
require base_path('views/movies/index.view.php');