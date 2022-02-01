<?php

include __DIR__.'/Model.php';

class TodoModel extends Model
{

    public function __construct()
    {
        parent::__construct("todo");
    }
}