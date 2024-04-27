<?php

namespace core;

class Validator
{
    protected array $errors = [];

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

    public function validate() :array
    {
        $errors = $this->errors;
        foreach($this->rules as $fieldKey => $ruleGroup)
        {
            foreach($ruleGroup as $rule)
            {
                $value = $this->data ?? null;

                $handlers = $this->getHandler();
                if(array_key_exists($rule, $handlers) &&!$handlers[$rule]($value))
                {
                    $this->addError("Validation failed for field '$fieldKey' with rule '$rule'");
                }
            }
        }
        foreach($this->errors as $oneError)
        {
            var_dump($oneError);
        }
        return $this->getErrors();
    }

    protected function getHandler() :array
    {
        return [
            'required' =>fn($value) =>empty($value['name']),
            'min3' =>fn($value) => mb_strlen($value['name'])<3,
            'max255' => fn($value) =>mb_strlen($value['name'])>255,
            'requiredStatus' =>fn($value) =>empty($value['status']),
        ];
    }
    public function addError(string $error): void
    {
        $this->errors[] = $error;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

}