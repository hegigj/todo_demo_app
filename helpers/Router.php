<?php

class Router
{
    private const GET_METHOD = 'GET';
    private const POST_METHOD = 'POST';

    private array $handlers = [];

    public function get($path, $handler)
    {
        $this->handlers[self::GET_METHOD.$path] = [
            'method' => self::GET_METHOD,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function post($path, $handler)
    {
        $this->handlers[self::POST_METHOD.$path] = [
            'method' => self::POST_METHOD,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];

        $callback = null;
        foreach ($this->handlers as $handler) {
            if (
                $handler['method'] === $requestMethod &&
                $handler['path'] === $requestPath
            ) {
                $callback = $handler['handler'];
            }
        }

        call_user_func_array($callback, array_merge($_GET, $_POST));
    }
}