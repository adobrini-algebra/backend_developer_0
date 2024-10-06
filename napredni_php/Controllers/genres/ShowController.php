<?php

namespace Controllers\genres;

use Core\Database;

class ShowController
{
    public function __invoke()        
    {
        if (!isset($_GET['id'])) {
            abort();
        }
        
        $db = Database::get();
        
        $sql = 'SELECT * from zanrovi WHERE id = :id';
        
        $genre = $db->query($sql, ['id' => $_GET['id']])->findOrFail();
        
        $movies = $db->query("SELECT f.*, c.tip_filma FROM filmovi f JOIN cjenik c ON f.cjenik_id = c.id WHERE zanr_id = :id", ['id' => $_GET['id']])->all();
        
        require base_path('views/genres/show.view.php');
    }
}

