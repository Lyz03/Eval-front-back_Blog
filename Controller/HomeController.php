<?php

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function default()
    {
        $this->render('home/home');
    }
}