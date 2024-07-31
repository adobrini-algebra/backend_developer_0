<?php

use Core\Session;

$pageTitle = 'Cjenik';
$errors = Session::get('errors');
require base_path('views/prices/create.view.php');
