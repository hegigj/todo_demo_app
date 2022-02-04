<?php

namespace Controllers;

use Models\AuthModel;
use Models\TodoModel;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->model = new TodoModel();
    }

    public function index(array $globals)
    {
        $todoList = [];

        $username = $globals[AuthController::USER_SESSION];
        $userModel = new AuthModel();
        $users = $userModel->fetchBy([
            'username' => $username
        ]);

        if (count($users) === 1) {
            $userId = $users[0]['id'];
            $limit = isset($globals['pageSize']) ? intval($globals['pageSize']) : 10;
            $offset = ((isset($globals['pageNo']) ? intval($globals['pageNo']) : 1) - 1) * $limit;

            $todoList = $this->model->fetchPaginatedBy($limit, $offset, array_merge(['userId' => $userId], $globals));
        }

        return include __DIR__.'/../views/todo.php';
    }

    function getById(int $id, array $globals)
    {
        // TODO: Implement getById() method.
    }
}