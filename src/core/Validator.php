<?php

namespace core;

class Validator
{
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
        foreach($this->rules as $fieldKey => $ruleGroup)
        {
            foreach($ruleGroup as $rule)
            {
                $value = $this->data[$fieldKey] ?? null;
                $handlers = $this->getHandler();
                if(array_key_exists($rule, $handlers) &&!$handlers[$rule]($value))
                {
                    return false;
                }
            }
        }
        return true;
    }

    protected function getHandler() :array
    {
        return [
            'required' =>fn($value) =>empty($value),
            'min3' =>fn($value) => mb_strlen($value)<3,
            'max255' => fn($value) =>mb_strlen($value)>255,
        ];
    }

}