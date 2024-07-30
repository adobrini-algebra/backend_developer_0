<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if (!isset($_POST['id'] ) || !isset($_POST['_method']) || $_POST['_method'] !== 'PATCH') {
    abort();
}

$db = Database::get();
$price = $db->query("SELECT * from mediji WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

$rules = [
    'tip' => ['required', 'string', 'min:2', 'max:100', 'unique:mediji,' . $_POST['id']],
    'koeficijent' => ['required', 'numeric', 'gt:0', 'max:8'],
];
    
$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}
    
$data = $form->getData();

$sql = "UPDATE mediji SET tip = :tip, koeficijent = :koeficijent WHERE id = :id";
$db->query($sql, [
    'tip' => $data['tip'],
    'koeficijent' => $data['koeficijent'],
    'id' => $price['id']
]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno uredjeni podaci o mediju {$data['tip']}"
]);

redirect('formats');
