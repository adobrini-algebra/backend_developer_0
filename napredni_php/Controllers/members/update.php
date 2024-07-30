<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if (!isset($_POST['id'] ) || !isset($_POST['_method']) || $_POST['_method'] !== 'PATCH') {
    abort();
}

$db = Database::get();
$member = $db->query("SELECT * from clanovi WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

$rules = [
    'id' => ['required', 'numeric'],
    'ime' => ['required', 'string', 'max:50', 'min:2'],
    'prezime' => ['required', 'string','max:50'],
    'adresa' => ['string','max:100'],
    'telefon' => ['phone','max:15'],
    'email' => ['required', 'email','max:50', 'unique:clanovi,' . $_POST['id']],
    'clanski_broj' => ['required', 'string', 'max:14', 'clanskiBroj', 'unique:clanovi,' . $_POST['id']],
];

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();


$sql = "UPDATE clanovi SET ime = :ime, prezime = :prezime, adresa = :adresa, telefon = :telefon, email = :email, clanski_broj = :clanski_broj WHERE id = :id";
$db->query($sql, [
    'ime' => $data['ime'],
    'prezime' => $data['prezime'],
    'adresa' => $data['adresa'],
    'telefon' => $data['telefon'],
    'email' => $data['email'],
    'clanski_broj' => $data['clanski_broj'],
    'id' => $member['id']
]);

$pageTitle = "Edit Member";

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno uredjeni podaci o clanu '{$data['ime']} {$data['prezime']}'."
]);

redirect('members');
