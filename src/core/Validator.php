<?php

namespace core;

class Validator
{
    public array $errors = [];
    public function __construct(
        protected array $rules,
        protected array $data
    )
    {

    }
    public static function make(array $rules, array $data) :Validator
    {
        return new static($rules, $data);
    }

    public function validate() :bool
    {
        //рулс єто массив имя поля - массив правил
        // филд ки, єто имя поля
        //рул груп єто массив значений поля
        //мы должны сравнить равняется ли поле пул тайп контролера полю, которое проверяет валидатор
        foreach($this->rules as $fieldKey => $ruleGroup)
        {
            foreach($ruleGroup as $rule)
            {
                $value = $this->data[$fieldKey] ?? null;


                $handlers = $this->getHandler();

                if(array_key_exists($rule, $handlers) &&$handlers[$rule]($value))
                {
                    $this->errors[] = "$fieldKey failed $rule validation";
                }
            }

        }
        return empty($this->errors);
    }

    protected function getHandler() :array
    {
        return [
            'required' =>fn($value) =>empty($value),
            'min3' =>fn($value) => mb_strlen($value)<3,
            'max255' => fn($value) =>mb_strlen($value)>255,
            'isDraft' => fn($value) => $value !== 'draft',
        ];
    }

}