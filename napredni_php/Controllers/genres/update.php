<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if (!isset($_POST['id'] ) || !isset($_POST['_method']) || $_POST['_method'] !== 'PATCH') {
    abort();
}

$db = Database::get();
$genre = $db->query('SELECT * FROM zanrovi WHERE id = ?', [$_POST['id']])->findOrFail();

$rules = [
    'ime' => ['required', 'string', 'max:100', 'unique:zanrovi'],
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();

$sql = "UPDATE zanrovi SET ime = ? WHERE id = ?";
$db->query($sql, [$data['ime'], $genre['id']]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno uredjen zanr {$data['ime']}."
]);

redirect('genres');
