<?php


namespace app\models;


use app\models\app\AppModel;

class User extends AppModel
{
    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => ''
    ];
    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['name'],
            ['email'],
            ['address']
        ],
        'email' => [
            ['email']
        ],
        'lengthBetween' => [
            ['password', 6, 30]
        ],
        'lengthMax' => [
            ['login', 100],
            ['name', 100],
            ['email', 100],
            ['address', 150]
        ]
    ];
}