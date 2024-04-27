<?php

namespace app\Controllers;

use core\Viewer;
use core\PDO;
use \app\Models\PollType;
use core\Validator;

class PollTypeController
{

    public function index() :void
    {
        $polltypes = PollType::all();

        (new Viewer('poll-types.index', compact(['polltypes'])))->render();
    }

    public function show() :void
    {

        $id = $_GET['id']??null;
        $data = PollType::find($id);

    }

    public function create() :void
    {
        (new Viewer('poll-types.create'))->render();

    }

    public function store()
    {
//        CHECK IT
        $data = [
            'name' => isset($_POST['name']) ? trim($_POST['name']) : null,
        ];

        $rules = [
            'name'=>['required', 'min3', 'max255'],
        ];

        if(!Validator::make($rules, $data)->validate()){
            header('Location:' . '/poll-types/create');
            exit();
        }
        PollType::make()->fill($data)->create();

        header('Location:' . '/poll-types');
        exit();
    }
}