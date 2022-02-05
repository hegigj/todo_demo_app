<?php

namespace Controllers;

use Models\AuthModel;
use Models\TodoModel;

use PDOException;

class TodoController extends Controller
{
    public const TODO_NAME = 'TODO_NAME';
    public const TODO_ERROR = 'TODO_ERROR';
    public const TODO_SUCCESS = 'TODO_SUCCESS';

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

    public function add()
    {
        $requestMethod = $this->globals['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                $_SESSION[self::TODO_SUCCESS] = null;
                return include __DIR__.'/../views/edit-todo.php';
            case 'POST':
                $username = $this->globals[AuthController::USER_SESSION];
                $userModel = new AuthModel();
                $users = $userModel->fetchBy([
                    'username' => $username
                ]);

                if (count($users) === 1) {
                    $name = $this->globals['name'];
                    $description = $this->globals['description'];
                    $dueDate = $this->globals['dueDate'];
                    $status = strtoupper($this->globals['status']);
                    $userId = $users[0]['id'];

                    $todoId = null;
                    try {
                        $todoId = $this->model->insert([
                            'name' => $name,
                            'description' => $description,
                            'dueDate' => date('Y-m-d H:i:s', strtotime($dueDate)),
                            'status' => $status,
                            'userId' => $userId,
                        ]);
                    } catch (PDOException $e) {
                        return include __DIR__.'/../views/edit-todo.php';
                    }
                    $_SESSION[self::TODO_SUCCESS] = 'Todo was inserted successfully 🥳';
                    header("Location: ../todo/$todoId");
                }
                break;
        }
        return false;
    }

    public function getById(int $id)
    {
        $requestMethod = $this->globals['REQUEST_METHOD'];

        if ($requestMethod === 'GET') {
            $username = $this->globals[AuthController::USER_SESSION];
            $userModel = new AuthModel();
            $users = $userModel->fetchBy([
                'username' => $username
            ]);

            if (count($users) === 1) {
                $userId = $users[0]['id'];

                $todos = $this->model->fetchBy([
                    'id' => $id,
                    'userId' => $userId
                ]);

                if (count($todos) === 1) {
                    $todo = $todos[0];

                    $id = $todo['id'];
                    $name = $todo['name'];
                    $userId = $todo['userId'];

                    $_SESSION[self::TODO_NAME] = $name;

                    $description = $todo['description'];
                    $dueDate = $todo['dueDate'];
                    $status = $todo['status'];

                    $oldValues = [
                        'id' => $id,
                        'name' => $name,
                        'description' => $description,
                        'dueDate' => date('Y-m-d\TH:i:s', strtotime($dueDate)),
                        'status' => $status
                    ];

                    return include __DIR__.'/../views/edit-todo.php';
                }
            }
        }
        return false;
    }

    public function edit(int $id): bool {
        $requestMethod = $this->globals['REQUEST_METHOD'];

        if ($requestMethod === 'POST') {
            $username = $this->globals[AuthController::USER_SESSION];
            $userModel = new AuthModel();
            $users = $userModel->fetchBy([
                'username' => $username
            ]);

            if (count($users) === 1) {
                $userId = $users[0]['id'];

                $todos = null;
                $errors = [];
                $oldValues = [];
                try {
                    $todos = $this->model->fetchBy([
                        'id' => $id,
                        'userId' => $userId
                    ]);
                } catch (PDOException $e) {
                    $errors['code'] = $e->getCode();
                    $errors['message'] = $e->getMessage();
                    return __DIR__.'/../views/edit-todo.php';
                }

                if (count($todos) === 1) {
                    $name = $this->globals['name'];
                    $description = $this->globals['description'];
                    $dueDate = $this->globals['dueDate'];
                    $status = strtoupper($this->globals['status'] ?? 'ACTIVE');

                    $oldValues = [
                        'id' => $id,
                        'name' => $name,
                        'description' => $description,
                        'dueDate' => date('Y-m-d\TH:i:s', strtotime($dueDate)),
                        'status' => $status,
                    ];

                    try {
                        $this->model->update(
                            [
                                'name' => $name,
                                'description' => $description,
                                'dueDate' => date('Y-m-d H:i:s', strtotime($dueDate)),
                                'status' => $status
                            ], [
                                'id' => $id,
                                'userId' => $userId
                            ]
                        );
                    } catch (PDOException $e) {
                        $errors['code'] = $e->getCode();
                        $errors['message'] = $e->getMessage();
                        $_SESSION[self::TODO_ERROR] = 'Unable to update this todo 🥲';
                        header("Location: ../../todo/$id");
                    }

                    $_SESSION[self::TODO_SUCCESS] = 'Todo was updated successfully 😇';
                    header("Location: ../../todo/$id");
                }
            }
        }
        header("Location: ../../todo/$id");
        return false;
    }
}