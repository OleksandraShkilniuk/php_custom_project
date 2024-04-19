<?php

namespace core;

class Viewer
{
    protected string $view;
    protected array $args;

    public function __construct(string $view, array $args = [] )
    {
        $this->view = $view;
        $this->args = $args;
    }

    public function render() :void
    {
        extract($this->args);
        include __DIR__ . './../views/' . str_replace('.', '/', $this->view) . '.php';

    }

}