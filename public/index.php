<?php

use App\Routeur;

session_start();

require __DIR__ . '/../include.php';
Routeur::route();
