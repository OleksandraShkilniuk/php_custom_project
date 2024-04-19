<?php

namespace app\Controllers;
use core\Viewer;

class UserController
{
    public function index() :void
    {

        $a = 2232322;
        $b = 'dsdsddss';
        (new Viewer('users.index', compact('a', 'b')))->render();
    }

    public function store()
    {

    }

    public function update()
    {

    }

    protected function isAdmin($user) :bool
    {
        return $user['role'] === 'admin';
    }

}