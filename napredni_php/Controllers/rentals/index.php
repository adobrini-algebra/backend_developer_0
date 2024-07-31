<?php

use Core\Database;

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
    ORDER BY p.id DESC";

$rentals = $db->query($sql)->all();

$pageTitle = 'Posudbe';
require base_path('views/rentals/index.view.php');