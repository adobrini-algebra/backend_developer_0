<?php

namespace Controllers\genres;

use Core\Database;
use Core\Session;
use Core\Validator;
use Core\ResourceInUseException;

class GenresController
{
    private Database $db;


    public function __construct()
    {
        $this->db = Database::get();
    }


    public function index()
    {
        $sql = "SELECT * from zanrovi ORDER BY id";
        $genres = $this->db->query($sql)->all();
    
        $pageTitle = 'Zanrovi';
    
        require base_path('/views/genres/index.view.php');
    }



    public function show()
    {
        if (!isset($_GET['id'])) {
            abort();
        }
        
        $sql = 'SELECT * from zanrovi WHERE id = :id';
        
        $genre = $this->db->query($sql, ['id' => $_GET['id']])->findOrFail();
        
        $movies = $this->db->query("SELECT f.*, c.tip_filma FROM filmovi f JOIN cjenik c ON f.cjenik_id = c.id WHERE zanr_id = :id", ['id' => $_GET['id']])->all();
        
        require base_path('views/genres/show.view.php');
    }



    public function edit()
    {
        if (!isset($_GET['id'])) {
            abort();
        }
        
        $genre = $this->db->query('SELECT * FROM zanrovi WHERE id = ?', [$_GET['id']])->findOrFail();
        
        $errors = Session::get('errors');
        
        $pageTitle = 'Zanrovi';
        
        require base_path('views/genres/edit.view.php');
    }



    public function update()
    {
        if (!isset($_POST['id'] )) {
            abort();
        }
        
        $genre = $this->db->query('SELECT * FROM zanrovi WHERE id = ?', [$_POST['id']])->findOrFail();
            
        $postData = [
            "ime" => $_POST['zanr'],
        ];
        
        $rules = [
            'ime' => ['required', 'string', 'max:100', 'unique:zanrovi'],
        ];
        
        $form = new Validator($rules, $postData);
        if ($form->notValid()){
            dd($form->errors());
        }
        
        $data = $form->getData();
        
        $sql = "UPDATE zanrovi SET ime = ? WHERE id = ?";
        $this->db->query($sql, [$data['ime'], $genre['id']]);
        
        redirect('/genres');
    }


    public function create()
    {
        $pageTitle = 'Zanrovi';
        require base_path('views/genres/create.view.php');
    }


    public function store()
    {        
        $postData = [
            'ime' => $_POST['zanr'] ?? null
        ];
        
        $rules = [
            'ime' => ['required', 'string', 'max:100', 'unique:zanrovi'],
        ];
        
        $form = new Validator($rules, $postData);
        if ($form->notValid()){
            Session::flash('errors', $form->errors());
            goBack();
        }
        
        $data = $form->getData();
        
        $sql = "INSERT INTO zanrovi (ime) VALUES (:ime)";
        $this->db->query($sql, ['ime' => $data['ime']]);
        
        redirect('/genres');
    }



    public function destroy()
    {
        if (!isset($_POST['id'])) {
            abort();
        }

        $genre = $this->db->query('SELECT * FROM zanrovi WHERE id = ?', [$_POST['id']])->findOrFail();

        try {
            $this->db->query('DELETE FROM zanrovi WHERE id = ?', [$genre['id']]);
        } catch (ResourceInUseException $e) {
            dd('nemere');
        }

        redirect('/genres');
    }
}
