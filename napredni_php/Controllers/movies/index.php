<?php

use Core\Database;
use Core\Session;

$db = Database::get();

// $sql = "SELECT
//             f.id, f.naslov, f.godina,
//             z.ime AS zanr,
//             c.tip_filma,
//             GROUP_CONCAT(DISTINCT m.tip,'-', m.id) AS medij
//         FROM
//             kopija k
//             JOIN filmovi f ON f.id = k.film_id
//             JOIN zanrovi z ON z.id = f.zanr_id
//             JOIN mediji m ON m.id = k.medij_id
//             JOIN cjenik c ON c.id = f.cjenik_id
//         WHERE k.dostupan = 1
//         GROUP BY f.id
//         ORDER BY f.id;";

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
            COUNT(k.id) AS 'kolicina'
        FROM
            kopija k
            JOIN filmovi f ON f.id = k.film_id
            JOIN zanrovi z ON z.id = f.zanr_id
            JOIN mediji m ON m.id = k.medij_id
            JOIN cjenik c ON c.id = f.cjenik_id
        WHERE k.dostupan = 1
        GROUP BY f.id, m.id
        ORDER BY f.id;";

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
$errors = Session::all('errors');
$message = Session::all('message');

Session::unflash();

$pageTitle = 'Filmovi';

require base_path('views/movies/index.view.php');