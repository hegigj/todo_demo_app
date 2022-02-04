<?php

namespace Controllers;

use Models\AuthModel;
use Models\TodoModel;

class TodoController extends Controller
{

    public function __construct(array $globals)
    {
        $this->globals = $globals;
        $this->model = new TodoModel();
    }

    public function index()
    {
        $todoList = [];

        $username = $this->globals[AuthController::USER_SESSION];
        $userModel = new AuthModel();
        $users = $userModel->fetchBy([
            'username' => $username
        ]);

        if (count($users) === 1) {
            $userId = $users[0]['id'];
            $limit = isset($this->globals['pageSize']) ? intval($this->globals['pageSize']) : 10;
            $offset = ((isset($this->globals['pageNo']) ? intval($this->globals['pageNo']) : 1) - 1) * $limit;

            $todoList = $this->model->fetchPaginatedBy($limit, $offset, array_merge(['userId' => $userId], $this->globals));
        }

        return include __DIR__.'/../views/todo.php';
    }

    function getById(int $id)
    {
        // TODO: Implement getById() method.
    }
}