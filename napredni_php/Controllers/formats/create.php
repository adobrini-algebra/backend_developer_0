<?php

use Core\Session;

$pageTitle = 'Medij';

$errors = Session::all('errors');
Session::unflash();

require base_path('views/formats/create.view.php');
