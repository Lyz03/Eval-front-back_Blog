<?php

use App\Routeur;
require __DIR__ . '/../include.php';

session_start();

Routeur::route();
