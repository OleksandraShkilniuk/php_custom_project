<?php

namespace app\Controllers;

use core\Viewer;
use core\PDO;
use \app\Models\PollType;
use core\Validator;
use app\Models\PollTypeQuestion;

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

        $rules = [
            'name'=>['required', 'min3', 'max255',],
        ];
        try{
            $validator = Validator::make($rules, $data);
            if(!$validator->validate()){
                $_SESSION['old'] = $data;

                header('Location:' . '/poll-types/create');
                exit();
            }
        } catch(\Exception $exception){

            $errorPath = __DIR__ . '/../../storage/logs/error.log';
            $errorMessage = date('Y-m-d H:i:s'). ':' . $exception->getMessage() . PHP_EOL;
            file_put_contents($errorPath, $errorMessage, FILE_APPEND);
            echo '500 Server error';

            echo file_get_contents($errorPath);
            exit();
        }

        PollType::make()->fill($data)->create();

        header('Location:' . '/poll-types');
        exit();
    }

    public function edit() :void
    {
        $id = $_GET['id']??null;
        if(!$id)
        {
            header('Location:' . '/poll-types');
            exit();
        }
        $pollType = PollType::find($id);
        $pollTypeQuestions = PollTypeQuestion::wherePollTypeID($id);
        (new Viewer('poll-types.edit', compact(['pollType', 'pollTypeQuestions'])))->render();


    }

    public function update() :void
    {
        $data = [
            'name' => isset($_POST['name']) ? trim($_POST['name']) : null,
            'id' => isset($_POST['id']) ? trim($_POST['id']) : null,


        ];

        $_SESSION['old'] = $data;

        $rules = [
            'id'=>['required'],
            'name'=>['required', 'min3', 'max255',],
        ];

        $validator = Validator::make($rules, $data);
        if(!$validator->validate()){
            header('Location:' . '/poll-types/edit?id=' . $data['id']);
            exit();
        }

        PollType::make()->fill($data)->update();

        header('Location:' . '/poll-types');
        exit();

    }
}