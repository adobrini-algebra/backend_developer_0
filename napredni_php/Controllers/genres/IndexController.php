<?php

namespace Controllers\genres;

use Core\Database;

// Invocable controller
class IndexController
{
    public function __invoke()
    {
        $db = Database::get();

        $sql = "SELECT * from zanrovi ORDER BY id";
        $genres = $db->query($sql)->all();
    
        $pageTitle = 'Zanrovi';
    
        require base_path('/views/genres/index.view.php');
    }

}
