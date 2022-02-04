<?php

namespace Controllers;

use Models\AuthModel;

class AuthController extends Controller
{
    public const USER_SESSION = 'TODO_LOGGED_USER';

    public function __construct(array $globals = [])
    {
        $this->globals = $globals;
        $this->model = new AuthModel();
    }

    public function login()
    {
        $requestMethod = $this->globals['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                return include __DIR__.'/../views/login.php';
            case 'POST':
                $username = $this->globals['username'];
                $password = $this->globals['password'];

                $users = $this->model->fetchBy([
                    'username' => $username
                ]);

                $errors = [];
                $oldValues = [
                    'username' => $username,
                    'password' => $password
                ];

                if (count($users)) {
                    if (password_verify($password, $users[0]['password'])) {
                        $_SESSION[self::USER_SESSION] = $username;
                        header('Location: ../todo');
                    } else {
                        $errors['password'] = 'Wrong password';
                    }
                } else {
                    $errors['username'] = 'Wrong username';
                }

                $_SESSION['errors'] = $errors;
                $_SESSION['oldValues'] = $oldValues;
                return include __DIR__.'/../views/login.php';
        }
        return false;
    }

    public function register() {
        $requestMethod = $this->globals['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                return include __DIR__.'/../views/register.php';
            case 'POST':
                $username = $this->globals['username'];
                $password = $this->globals['password'];
                $confirmPassword = $this->globals['confirmPassword'];

                $errors = [];
                $oldValues = [
                    'username' => $username,
                    'password' => $password,
                    'confirmPassword' => $confirmPassword
                ];

                if ($password === $confirmPassword) {
                    if (
                        $this->model->insert([
                            'username' => $username,
                            'password' => password_hash($password, PASSWORD_DEFAULT),
                            'role' => 3
                        ])
                    ) {
                        $_SESSION[self::USER_SESSION] = $username;
                        header('Location: ../todo');
                    }
                } else {
                    $errors['password'] = 'Password does not match with confirm password';
                    $errors['confirmPassword'] = 'Confirmed password does not match with password';
                }

                $_SESSION['errors'] = $errors;
                $_SESSION['oldValues'] = $oldValues;
                return include __DIR__.'/../views/register.php';
        }
        return false;
    }

    public function logout() {
        $_SESSION[AuthController::USER_SESSION] = null;
        return include __DIR__.'/../views/login.php';
    }

    function index()
    {
        // TODO: Implement index() method.
    }

    function getById(int $id)
    {
        // TODO: Implement getById() method.
    }
}