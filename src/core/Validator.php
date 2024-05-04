<?php

namespace core;

use Exception;

class Validator
{
    public function __construct(protected array $rules, protected array $data)
    {
    }

    public static function make(array $rules, array $data): Validator
    {
        return new static($rules, $data);
    }

    public function validate(): bool
    {
        /*
         * $ruleGroup = ['required', 'min:3', 'max:20'];
         */
        foreach ($this->rules as $fieldKey => $ruleGroup) {
            foreach ($ruleGroup as $rule) {
                $value = $this->data[$fieldKey] ?? null;
                $handlers = $this->getHandlers();

                if (!array_key_exists($rule, $handlers)) {
                    throw new Exception("Rule {$rule} not found");
                }

                $handler = $handlers[$rule];

                if ($handler['validator']($value)) {
                    $message = $handler['messageRender']($fieldKey);
                    
                    $_SESSION['errors'] = [
                        $fieldKey => $message
                    ];

                    return false;
                }
            }
        }

        return true;
    }

    protected function getHandlers(): array
    {
        return [
            'required' => [
                'validator' => fn($value) => empty($value),
                'messageRender' => fn($fieldKey) => "Field {$fieldKey} is required",
            ],
            'min3' => [
                'validator' => fn($value) => mb_strlen($value) < 3,
                'messageRender' => fn($fieldKey) => "Field {$fieldKey} min 3",
            ],
            'max255' => [
                'validator' => fn($value) => mb_strlen($value) > 255,
                'messageRender' => fn($fieldKey) => "Field {$fieldKey} max",
            ],
        ];
    }
}