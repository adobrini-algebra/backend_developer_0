<?php

use Core\Database;
use Core\Session;

$db = Database::get();

$sql = "SELECT p.*,
        c.clanski_broj, c.ime, c.prezime,
        pk.kopija_id,
        k.barcode, k.dostupan, k.film_id, k.medij_id,
        f.naslov, f.cjenik_id,
        m.tip AS medij, m.koeficijent,
        cj.tip_filma, cj. cijena, cj. zakasnina_po_danu AS zakasnina
    from posudba p 
    JOIN clanovi c ON c.id = p.clan_id
    JOIN posudba_kopija pk ON p.id = pk.posudba_id
    JOIN kopija k ON pk.kopija_id = k.id
    JOIN filmovi f ON k.film_id = f.id
    JOIN mediji m ON k.medij_id = m.id
    JOIN cjenik cj ON f.cjenik_id = cj.id
    WHERE p.datum_povrata IS NULL
    ORDER BY p.id DESC";

$rentals = $db->query($sql)->all();
$members = $db->query("SELECT * from clanovi ORDER BY id")->all();
$movies  = $db->query("SELECT * from filmovi ORDER BY id")->all();
$formats = $db->query("SELECT * from mediji ORDER BY id")->all();

$errors = Session::all('errors');
$message = Session::all('message');
Session::unflash();

$pageTitle = 'Dashboard';

require base_path('views/dashboard/index.view.php');