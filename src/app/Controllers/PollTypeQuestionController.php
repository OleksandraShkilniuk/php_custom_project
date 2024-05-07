<?php

namespace app\Controllers;

use core\Viewer;
use core\PDO;
use \app\Models\PollTypeQuestion;
use core\Validator;

class PollTypeQuestionController
{

    public function store(): void
    {
        $data = [
            'question' => isset($_POST['question']) ? trim($_POST['question']) : null,
            'poll_type_id' => isset($_POST['poll_type_id']) ? trim($_POST['poll_type_id']) : null,


        ];

        $rules = [
            'question' => ['required', 'min3', 'max255',],
            'poll_type_id' => ['required',],

        ];

        $validator = Validator::make($rules, $data);
        if (!$validator->validate()) {
            $_SESSION['old'] = $data;

            header('Location:' . '/poll-types/edit?id=' . $data['poll_type_id']);
            exit();
        }

        PollTypeQuestion::make()->fill($data)->create();

        header('Location:' . '/poll-types/edit?id=' . $data['poll_type_id']);
        exit();
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location:' . '/poll-types/edit?id=' . $_GET['poll_type_id']);
            exit();
        }

        PollTypeQuestion::delete($id);
        header('Location:' . '/poll-types/edit?id=' . $_GET['poll_type_id']);
        exit();
    }

}