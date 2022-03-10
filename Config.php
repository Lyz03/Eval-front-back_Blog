<?php

namespace App;

class Config
{
    // DATABASE
    public const DB_CHARSET = 'utf8';
    public const DB_NAME = 'eval_front_back';
    public const DB_HOST = 'localhost';
    public const DB_USERNAME = 'root';
    public const DB_PASSWORD = '';

    //ARTICLE
    public const ALLOWED_TAGS = [
        '<h2>',
        '<h3>',
        '<h4>',
        '<p>',
        '<span>',
        '<div>',
        '<i>',
        '<b>',
        '<u>',
        '<style>'
    ];
}