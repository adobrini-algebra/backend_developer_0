<?php

namespace Controllers;

use Core\Database;

class DashboardController
{
    public function index()
    {
        $db = Database::get();

        $sql = "SELECT 
            p.id AS pid,
            k.id AS kid,
            p.datum_posudbe, 
            CONCAT(c.clanski_broj, ' - ' , c.ime, ' ', c.prezime) AS clan, 
            f.naslov, 
            m.tip,
            CONCAT(cj.cijena, ' € - ', cj.tip_filma) AS cijena_tip_filma
        FROM posudba p
        JOIN posudba_kopija pk ON p.id = pk.posudba_id
        JOIN kopija k ON k.id = pk.kopija_id
        JOIN filmovi f ON f.id = k.film_id
        JOIN clanovi c ON c.id = p.clan_id
        JOIN cjenik cj ON cj.id = f.cjenik_id
        JOIN mediji m ON m.id = k.medij_id
        WHERE p.datum_povrata IS NULL
        ORDER BY p.id DESC";

        $rentals = $db->query($sql)->all();

        $pageTitle = 'Dashboard';

        require_once base_path('views/dashboard/index.view.php');
    }
}