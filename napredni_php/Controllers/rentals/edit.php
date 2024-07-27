<?php

use Core\Database;
use Core\Session;

if (!isset($_GET['pid']) || !isset($_GET['kid'])) {
    abort();
}

$db = Database::get();

$sql = "SELECT p.*,
            CASE 
                WHEN p.datum_povrata IS NULL THEN DATEDIFF(NOW(), p.datum_posudbe)
                ELSE DATEDIFF(p.datum_povrata, p.datum_posudbe)
            END AS total_days,
            IF(p.datum_povrata IS NULL, 0, 1) AS returned,
            c.clanski_broj, c.ime, c.prezime,
            pk.kopija_id,
            k.barcode, k.dostupan, k.film_id, k.medij_id,
            f.naslov, f.cjenik_id,
            m.tip AS medij, m.koeficijent,
            cj.tip_filma,
            ROUND(cj. cijena * m.koeficijent, 2) AS price,
            ROUND(cj. zakasnina_po_danu * m.koeficijent, 2) AS late_fee
        from posudba p 
            JOIN clanovi c ON c.id = p.clan_id
            JOIN posudba_kopija pk ON p.id = pk.posudba_id
            JOIN kopija k ON pk.kopija_id = k.id
            JOIN filmovi f ON k.film_id = f.id
            JOIN mediji m ON k.medij_id = m.id
            JOIN cjenik cj ON f.cjenik_id = cj.id
        WHERE p.id = :pid AND k.id = :kid";

$rental = $db->query($sql, ['pid' => $_GET['pid'], 'kid' => $_GET['kid']])->findOrFail();

$rental['late_days'] = $rental['total_days'] <= 0 ? 0 : $rental['total_days'] - 1;
$rental['late_fee_total'] = $rental['late_fee'] * $rental['late_days'];
$rental['late_fee_formatted'] = formatPrice($rental['late_fee'] * $rental['late_days']);
$rental['total_price'] = formatPrice($rental['price'] + $rental['late_fee_total']);
$rental['price'] = formatPrice($rental['price']);
$rental['late_fee'] = formatPrice($rental['late_fee']);

$members = $db->query("SELECT * from clanovi ORDER BY id")->all();
$movies = $db->query("SELECT * from filmovi ORDER BY id")->all();
$formats = $db->query("SELECT * from mediji ORDER BY id")->all();

$pageTitle = 'Uredi Posudbu';

$message = Session::all('message');
$errors = Session::all('errors');
Session::unflash();

require base_path('views/rentals/edit.view.php');

