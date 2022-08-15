<?php

namespace tarum\phpmvc;

use \tarum\phpmvc\exception\NotFoundException;

/**
 *
 * @package tarum\phpmvc
 *
 */
class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     *
     * @param \tarum\phpmvc\Request $request
     * @param \tarum\phpmvc\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
            //return $this->renderView("_error");


        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            /** @var \tarum\phpmvc\Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddleware() as $middleware) {
                $middleware->execute();
            }

        }

        return call_user_func($callback, $this->request, $this->response);
    }
}
