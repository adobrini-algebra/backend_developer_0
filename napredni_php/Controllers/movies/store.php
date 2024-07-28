<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    dd('Unsupported method!');
}
    
$rules = [
    'naslov' => ['required', 'string', 'max:100', 'min:2'],
    'godina' => ['required', 'numeric','max:4'],
    'zanr' => ['required', 'numeric', 'exists:zanrovi,id'],
    'cijena' => ['required', 'numeric', 'exists:cjenik,id'],
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();

$db = Database::get();

$sql = "INSERT INTO filmovi (naslov, godina, zanr_id, cjenik_id) VALUES (:naslov, :godina, :zanr, :cijena)";

$db->query($sql, [
    'naslov' => $data['naslov'],
    'godina' => $data['godina'],
    'zanr' => $data['zanr'],
    'cijena' => $data['cijena']
]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno kreiran Film {$data['naslov']}"
]);

redirect('movies');
