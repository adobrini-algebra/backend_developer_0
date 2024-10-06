<?php

namespace Controllers;

use Core\Database;
use Core\Session;
use Core\Validator;

class RegisterController
{
    public function __construct()
    {
        if (Session::has('user')){
            redirect('/dashboard');
        }
    }

    public function create()
    {
        $pageTitle = 'Register';
        $errors = Session::get('errors');
        require_once base_path('views/register/create.view.php');
    }

    public function store()
    {
        // validirati podatke iz forme
        $rules = [
            'ime' => ['required', 'string', 'max:50', 'min:2'],
            'prezime' => ['required', 'string','max:50'],
            'adresa' => ['string','max:100'],
            'telefon' => ['phone','max:15'],
            'email' => ['required', 'email', 'max:50', 'unique:clanovi'],
            'password' => ['required', 'password', 'min:3', 'max:255']
        ];
        
        $db = Database::get();

        $form = new Validator($rules, $_POST);
        if ($form->notValid()){
            Session::flash('errors', $form->errors());
            goBack();
        }
        
        $data = $form->getData();

        // krerati novog membera
        $sql = "SELECT clanski_broj FROM clanovi ORDER BY id DESC LIMIT 1";
        $clanskiBroj = $db->query($sql)->find();
        $clanskiBroj = str_replace('CLAN','', $clanskiBroj['clanski_broj']);
        $clanskiBroj = intval($clanskiBroj);
        $clanskiBroj = 'CLAN' . ++$clanskiBroj;

        $sql = "INSERT INTO clanovi (ime, prezime, adresa, telefon, email, clanski_broj, password)
            VALUES (:ime, :prezime, :adresa, :telefon, :email, :clanski_broj, :pwd)";
        $db->query($sql, [
            'ime' => $data['ime'],
            'prezime' => $data['prezime'],
            'adresa' => $data['adresa'],
            'telefon' => $data['telefon'],
            'email' => $data['email'],
            'clanski_broj' => $clanskiBroj,
            'pwd' => password_hash($data['password'], PASSWORD_BCRYPT)
        ]);

        //ulogiraj clana
        $this->login($data);

        Session::flash('message', [
            'type' => 'success',
            'message' => "Uspjesno kreiran vas korisnicki racun"
        ]);

        redirect('/dashboard');
    }

    private function login($data)
    {
        Session::put('user', [
            'email' => $data['email'],
        ]);

        session_regenerate_id();
    }

}