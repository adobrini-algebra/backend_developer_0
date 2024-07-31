<?php

use Core\Session;

$errors = Session::get('errors');
$pageTitle = 'Zanrovi';
require base_path('views/genres/create.view.php');
