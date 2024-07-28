<?php

use Core\Session;

$errors = Session::all('errors');
Session::unflash();

$pageTitle = 'Zanrovi';
require base_path('views/genres/create.view.php');
