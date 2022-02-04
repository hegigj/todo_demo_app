<?php

namespace Models;

class TodoModel extends Model
{

    public function __construct()
    {
        parent::__construct("todo");
        $this->fields = ['id', 'name', 'description', 'dueDate', 'status', 'userId'];
    }
}