<?php

use Core\Database;
use Core\Session;
use Core\Validator;

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    dd('Unsupported method!');
}

$rules = [
    'tip' => ['required', 'string', 'min:2', 'max:100', 'unique:mediji'],
    'koeficijent' => ['required', 'numeric', 'gt:0', 'max:8'],
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();
$db = Database::get();

$sql = "INSERT INTO mediji (tip, koeficijent) VALUES (:tip, :koeficijent)";
$db->query($sql, [
    'tip' => $data['tip'],
    'koeficijent' => $data['koeficijent'],
]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno kreiran novi medji {$data['tip']}"
]);

redirect('formats');
