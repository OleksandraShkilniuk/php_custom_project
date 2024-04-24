<?php

namespace app\Controllers;

use core\Viewer;
use core\PDO;
use \app\Models\PollType;

class PollTypeController
{

    public function index() :void
    {

        $data = PollType::all();

        (new Viewer('poll-types.index', []))->render();
    }

    public function show() :void
    {

        $id = $_GET['id']??null;
        $data = PollType::find($id);

        var_dump($data);
    }

}