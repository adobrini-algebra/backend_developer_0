<?php

use Core\Session;

$pageTitle = 'Medij';
$errors = Session::get('errors');
require base_path('views/formats/create.view.php');
