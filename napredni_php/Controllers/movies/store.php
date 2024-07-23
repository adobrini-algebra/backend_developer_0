<?php

use Core\Database;

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    dd('Unsupported method!');
}
    
$data = [
    "ime" => $_POST['title'],
    "godina" => $_POST['year'],
    "zanr" => $_POST['genre'],
    "cijena" => $_POST['price'],
];

//validacija
foreach ($data as $key => $value) {
    // Provjera ima li praznih polja
    if(empty($value)){
        dd("Polje $key ne smije biti prazno");
    }
    if($data['zanr'] === "Odaberite zanr"){
        dd("Odaberite Zanr");
    }
    if($data['cijena'] === "Odaberite cijenu"){
        dd("Odaberite cijenu");
    }
}

$db = new Database();

$sql = "INSERT INTO filmovi (naslov, godina, zanr_id, cjenik_id) VALUES (:naslov, :godina, :zanr_id, :cjenik_id)";

$db->query($sql, [
    'naslov' => $data['ime'],
    'godina' => $data['godina'],
    'zanr_id' => $data['zanr'],
    'cjenik_id' => $data['cijena']
]);

redirect('movies');
