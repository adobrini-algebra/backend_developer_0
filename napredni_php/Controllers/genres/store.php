<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    dd('Unsupported method!');
}

$rules = [
    'ime' => ['required', 'string', 'max:100', 'unique:zanrovi'],
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();

$db = Database::get();

$sql = "INSERT INTO zanrovi (ime) VALUES (:ime)";
$db->query($sql, ['ime' => $data['ime']]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno kreiran zanr {$data['ime']}."
]);

redirect('genres');
