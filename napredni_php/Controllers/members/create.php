<?php

use Core\Session;

$pageTitle = 'Clanovi';
$errors = Session::get('errors');
require base_path('views/members/create.view.php');
