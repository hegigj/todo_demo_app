<?php

namespace Controllers;

use Models\Model;

abstract class Controller
{
    protected Model $model;

    abstract function index(array $globals);

    abstract function getById(int $id, array $globals);
}