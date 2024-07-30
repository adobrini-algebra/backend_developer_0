<?php

use Core\Database;
use Core\Session;
use Core\Validator;

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    dd('Unsupported method!');
}

$rules = [
    'tip_filma' => ['required', 'string', 'min:2', 'max:20', 'unique:cjenik'],
    'cijena' => ['required', 'numeric', 'gt:0', 'max:8'],
    'zakasnina' => ['required', 'numeric', 'gt:0', 'max:8'],
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();
$db = Database::get();

$sql = "INSERT INTO cjenik (tip_filma, cijena, zakasnina_po_danu) VALUES (:tip_filma, :cijena, :zakasnina)";
$db->query($sql, [
    'tip_filma' => $data['tip_filma'],
    'cijena' => $data['cijena'],
    'zakasnina' => $data['zakasnina'],
]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno kreirana cijena {$data['tip_filma']}"
]);

redirect('prices');
