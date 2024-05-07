<?php

namespace app\Models;
use core\PDO;

class PollTypeQuestion
{
    public array $attributes=[];

//    static methods

    public static function wherePollTypeID(int $pollTypeID): array
    {
        return array_map(
            fn($item)=>self::make()->fill($item),
            PDO::init()->query('SELECT * FROM poll_types_questions WHERE poll_type_id=' . $pollTypeID)->fetchAll()
        );
    }
    public static function all(): array
    {
        return array_map(
            fn($item)=>self::make()->fill($item),
            PDO::init()->query('SELECT * FROM poll_types_questions')->fetchAll()
        );
    }

    public function fill(array $attributes) :PollTypeQuestion
    {
        $this->attributes = $attributes;
        return $this;
    }

    public static function find(int $id) :PollTypeQuestion
    {
        $stmt = PDO::init()->prepare('SELECT * FROM poll_types_questions WHERE id = :id');
        $stmt->execute(['id'=>$id]);

        return self::make()->fill($stmt->fetchAll());
    }

    public function create() :bool
    {
        $stmt = PDO::init()->prepare("INSERT INTO poll_types_questions (question, poll_type_id) VALUES (:question, :poll_type_id)");

        return $stmt->execute($this->attributes);
    }

    public function update() :bool
    {
        $stmt = PDO::init()->prepare("UPDATE poll_types_questions SET question =:question, poll_type_id =:poll_type_id WHERE id=:id");

        return $stmt->execute($this->attributes);

    }

    public static function delete(int $id) :bool
    {
        $stmt = PDO::init()->prepare("DELETE FROM poll_types_questions WHERE id=:id");

        return $stmt->execute(['id' => $id]);

    }

    public static function make() :PollTypeQuestion
    {
        return new static;
    }

}