<?php

use Core\Session;

$pageTitle = 'Cjenik';

$errors = Session::all('errors');
Session::unflash();

require base_path('views/prices/create.view.php');
