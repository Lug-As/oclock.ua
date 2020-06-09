<?php


namespace app\controllers\app;


use app\models\app\AppModel;
use app\models\User;
use oclock\base\Controller;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        User::authentication();
    }
}