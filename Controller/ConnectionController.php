<?php

use App\Controller\AbstractController;

class ConnectionController extends AbstractController
{

    public function default()
    {
        $this->render('user/connection-inscription');
    }
}