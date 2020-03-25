<?php


namespace oclock\base;


use oclock\DB;

abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        DB::instance();
    }
}