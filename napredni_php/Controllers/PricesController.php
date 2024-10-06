<?php

namespace Controllers;

use Core\Database;
use Core\Session;
use Core\Validator;
use Core\ResourceInUseException;

class PricesController
{
    private Database $db;


    public function __construct()
    {
        if (Session::has('user') === false){
            redirect('/');
        }

        $this->db = Database::get();
    }


    public function index()
    {
        $sql = "SELECT * from cjenik ORDER BY id";
        $prices = $this->db->query($sql)->all();
    
        $pageTitle = 'Cjenik';
    
        require base_path('views/prices/index.view.php');
    }



    public function show()
    {
        if (!isset($_GET['id'])) {
            abort();
        }
        
        $sql = 'SELECT * from cjenik WHERE id = :id';
        
        $price = $this->db->query($sql, ['id' => $_GET['id']])->findOrFail();
        
        require base_path('views/prices/show.view.php');
    }



    public function edit()
    {
        if (!isset($_GET['id'])) {
            abort();
        }
        
        $price = $this->db->query('SELECT * FROM cjenik WHERE id = ?', [$_GET['id']])->findOrFail();
        
        $errors = Session::get('errors');
        
        $pageTitle = 'Cjenik';
        
        require base_path('views/prices/edit.view.php');
    }



    public function update()
    {
        if (!isset($_POST['id'] )) {
            abort();
        }
        
        $price = $this->db->query('SELECT * FROM cjenik WHERE id = ?', [$_POST['id']])->findOrFail();
        
        $rules = [
            'tip_filma' => ['required', 'string', 'max:20', 'min:2', 'unique:cjenik,' . $price['id']],
            'cijena' => ['required', 'numeric', 'max:10'],
            'zakasnina_po_danu' => ['required', 'numeric', 'max:10'],
        ];
        
        $form = new Validator($rules, $_POST);
        if ($form->notValid()){
            Session::flash('errors', $form->errors());
            goBack();
        }
        
        $data = $form->getData();
        
        $sql = "UPDATE cjenik SET tip_filma = ?, cijena = ?, zakasnina_po_danu = ? WHERE id = ?";
        $this->db->query($sql, [$data['tip_filma'], $data['cijena'], $data['zakasnina_po_danu'], $price['id']]);
        
        Session::flash('message', [
            'type' => 'success',
            'message' => "Uspješno uređeni cjenik {$data['tip_filma']}."
        ]); 

        redirect('/prices');
    }


    public function create()
    {
        $pageTitle = 'Cjenik';
        require base_path('views/prices/create.view.php');
    }


    public function store()
    {
        $rules = [
            'tip_filma' => ['required', 'unique:cjenik', 'string', 'max:20', 'min:2'],
            'cijena' => ['required', 'numeric', 'max:10'],
            'zakasnina_po_danu' => ['required', 'numeric', 'max:10'],
        ];
        
        $form = new Validator($rules, $_POST);
        if ($form->notValid()){
            Session::flash('errors', $form->errors());
            goBack();
        }
        
        $data = $form->getData();
        
        $sql = "INSERT INTO cjenik (tip_filma, cijena, zakasnina_po_danu) VALUES (?, ?, ?)";
        $this->db->query($sql, [$data['tip_filma'], $data['cijena'], $data['zakasnina_po_danu']]);
        
        Session::flash('message', [
            'type' => 'success',
            'message' => "Uspješno kreiran tip filma {$data['tip_filma']}."
        ]);   

        redirect('/prices');
    }



    public function destroy()
    {
        if (!isset($_POST['id'])) {
            abort();
        }

        $price = $this->db->query('SELECT * FROM cjenik WHERE id = ?', [$_POST['id']])->findOrFail();

        try {
            $this->db->query('DELETE FROM cjenik WHERE id = ?', [$price['id']]);
        } catch (ResourceInUseException $e) {
            Session::flash('message', [
                'type' => 'danger',
                'message' => "Ne možete obrisati cjenik {$price['tip_filma']} prije nego obrišete njegove posudbe."
            ]);
            goBack();
        }

        Session::flash('message', [
            'type' => 'success',
            'message' => "Uspješno obrisan cjenik '{$price['tip_filma']}'."
        ]);

        redirect('/prices');
    }
}
