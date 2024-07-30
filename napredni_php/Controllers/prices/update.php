<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if (!isset($_POST['id'] ) || !isset($_POST['_method']) || $_POST['_method'] !== 'PATCH') {
    abort();
}

$db = Database::get();
$price = $db->query("SELECT * from cjenik WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

$rules = [
    'id' => ['required', 'numeric'],
    'tip_filma' => ['required', 'string', 'min:2', 'max:20', 'unique:cjenik,' . $_POST['id']],
    'cijena' => ['required', 'numeric', 'gt:0', 'max:8'],
    'zakasnina' => ['required', 'numeric', 'gt:0', 'max:8'],
];
    
$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}
    
$data = $form->getData();

$sql = "UPDATE cjenik SET tip_filma = :tip_filma, cijena = :cijena, zakasnina_po_danu = :zakasnina WHERE id = :id";
$db->query($sql, [
    'tip_filma' => $data['tip_filma'],
    'cijena' => $data['cijena'],
    'zakasnina' => $data['zakasnina'],
    'id' => $price['id']
]);

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno uredjena podaci o cijenai {$data['tip_filma']}"
]);

redirect('prices');
