<?php

namespace Controllers;

use Models\TodoModel;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->model = new TodoModel();
    }

    public function index(array $globals)
    {
        $todoList = $this->model->fetchAll();

        return include __DIR__.'/../views/todo.php';
    }

    function getById(int $id, array $globals)
    {
        // TODO: Implement getById() method.
    }
}