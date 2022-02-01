<?php

include __DIR__.'/Controller.php';
include __DIR__.'/../models/TodoModel.php';

class TodoController extends Controller
{

    public function __construct()
    {
        $this->model = new TodoModel();
    }

    public function index()
    {
        $todoList = $this->model->fetchAll();

        return include 'views/todo.php';
    }
}