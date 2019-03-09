<?php

namespace App\Core;

use App\Core\Exceptions\ValidatorException;

class SimpleValidator
{
    const REQUIRED = 'required';
    const ARRAY = 'array';
    const STRING = 'string';
    const INT = 'int';
    const NOT_EMPTY = 'notempty';

    protected $errors = [];

    public function check(array $array, array $rules)
    {

        foreach ($rules as $key => $values) {

            foreach ($values as $rule) {
                if ($rule === self::REQUIRED) {
                    if (!isset($array[$key]))
                        $this->errors[] = $key . ' is required';
                }

                if ($rule === self::ARRAY) {
                    if (isset($array[$key]) && !is_array($array[$key])) {
                        $this->errors[] = $key . ' must be array';
                    }
                }

                if ($rule === self::STRING) {
                    if (isset($array[$key]) && !is_string($array[$key])) {
                        $this->errors[] = $key . ' must be string';
                    }
                }

                if ($rule === self::INT) {
                    if (isset($array[$key]) && !is_int($array[$key])) {
                        $this->errors[] = $key . ' must be integer';
                    }
                }

                if ($rule === self::NOT_EMPTY) {
                    if (isset($array[$key]) && empty($array[$key])) {
                        $this->errors[] = $key . ' must be not empty';
                    }
                }
            }
        }

        return $this;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate() {

        if ($this->hasErrors()) {
            throw new ValidatorException(implode(', ', $this->getErrors()));
        }
    }

}