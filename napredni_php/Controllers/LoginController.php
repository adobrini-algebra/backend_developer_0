<?php

namespace Controllers;

use Core\Database;
use Core\Session;
use Core\Validator;

class LoginController
{
    public function create()
    {
        if (Session::has('user')){
            redirect('/dashboard');
        }

        $pageTitle = 'Login';
        $errors = Session::get('errors');
        require_once base_path('views/login/create.view.php');
    }

    public function store()
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'password']
        ];
        
        $db = Database::get();

        $form = new Validator($rules, $_POST);
        if ($form->notValid()){
            Session::flash('errors', $form->errors());
            goBack();
        }
        
        $data = $form->getData();
        
        // provjeriti da li postoji user sa datim emailom u bazi
        $user = $db->query("SELECT * FROM clanovi WHERE email = ?", [$data['email']])->find();

        // if (password_hash($data['password'], PASSWORD_BCRYPT) === $user['password'])

        if ($user && password_verify($data['password'], $user['password'])) {
            $this->login($data);
            redirect('/dashboard');
        } else {
            Session::flash('errors', ['email' => 'Vas email ili passsord ne valjaju']);
            redirect('/login');
        }
    }

    public function login($data)
    {
        Session::put('user', [
            'email' => $data['email'],
        ]);

        session_regenerate_id();
    }

    public function logout()
    {
        Session::destroy();
        redirect('/');
    }
}