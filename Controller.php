<?php

namespace tarum\phpmvc;


use tarum\phpmvc\middlewares\BaseMiddleware;

/**
 *
 * @package tarum\phpmvc
 */
class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var \tarum\phpmvc\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    public function render($view, $params = []): array|bool|string
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middlewares;
    }
}