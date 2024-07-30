<?php

use Core\Database;
use Core\Validator;
use Core\Session;

if (!isset($_POST['id'] ) || !isset($_POST['_method']) || $_POST['_method'] !== 'PATCH') {
    abort();
}

$db = Database::get();
$movie = $db->query("SELECT * from filmovi WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

$rules = [
    'id' => ['required', 'numeric'],
    'naslov' => ['required', 'string', 'max:100', 'min:2'],
    'godina' => ['required', 'numeric','max:4'],
    'zanr' => ['required', 'numeric', 'exists:zanrovi,id'],
    'cijena' => ['required', 'numeric', 'exists:cjenik,id'],
];

$formats = $db->query("SELECT * FROM mediji ORDER BY id")->all();
foreach ($formats as $format) {
    $rules[$format['tip']] = ['numeric', 'gt:0', 'lt:20'];
}

$form = new Validator($rules, $_POST);
if ($form->notValid()){
    Session::flash('errors', $form->errors());
    goBack();
}

$data = $form->getData();

try {
    $db->connection()->beginTransaction();

    $sql = "UPDATE filmovi SET naslov = :naslov, godina = :godina, zanr_id = :zanr, cjenik_id = :cijena WHERE id = :id";
    $db->query($sql, [
        'naslov' => $data['naslov'],
        'godina' => $data['godina'],
        'zanr' => $data['zanr'],
        'cijena' => $data['cijena'],
        'id' => $data['id']
    ]);

    //TODO: move the following logic to a service for reuse in movies/create
    $values = [];
    $params = [];

    foreach ($formats as $format) {
        $medium = $format['tip'];

        if (!isset($data[$medium])) {
            continue;
        }

        $barcode = explode(' ', $data['naslov']);
        $barcode = mb_strtoupper(sprintf('%s%s-%s-%s',
            $barcode[0],
            count($barcode) > 1 ? end($barcode) : '',
            $data['godina'],
            str_replace('-', '', $medium)
        ));

        for ($i=0; $i < $data[$medium]; $i++) {
            $values[] = "(?, ?, ?, ?)";
            $params[] = $barcode;
            $params[] = 1;
            $params[] = $data['id'];
            $params[] = $format['id'];
        }
    }

    if (!empty($values)) {
        $sql = "INSERT INTO kopija (barcode, dostupan, film_id, medij_id) VALUES " . implode(', ', $values);
        $db->query($sql, $params);
    }

    $db->connection()->commit();
} catch (\Exception $e) {
    $db->connection()->rollBack();
    throw $e;
}

Session::flash('message', [
    'type' => 'success',
    'message' => "Uspjesno uredjeni podaci o filmu {$data['naslov']}"
]);

redirect('movies');
