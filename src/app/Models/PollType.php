<?php

namespace app\Models;
use core\PDO;

class PollType
{
    public array $attributes = [];
    public static function all(): array
    {
        return PDO::init()->query('SELECT * FROM poll_types')->fetchAll();
    }

    public static function find(int $id) :array
    {
        $stmt = PDO::init()->prepare('SELECT * FROM poll_types WHERE id = :id');
        $stmt->execute(['id'=>$id]);

        return $stmt->fetchAll();
    }

}