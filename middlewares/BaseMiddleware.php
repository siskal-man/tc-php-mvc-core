<?php

namespace tarum\phpmvc\middlewares;

abstract class BaseMiddleware
{
    abstract public function execute();
}