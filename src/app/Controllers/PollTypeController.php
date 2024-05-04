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

    public function store() :void
    {
        $data = [
            'name' => isset($_POST['name']) ? trim($_POST['name']) : null,

        ];

        $_SESSION['old'] = $data;

        $rules = [
            'name'=>['required', 'min3', 'max255',],
        ];
        $validator = Validator::make($rules, $data);

        if(!$validator->validate()){
            header('Location:' . '/poll-types/create');
            exit();
        }
        PollType::make()->fill($data)->create();

        header('Location:' . '/poll-types');
        exit();
    }
}