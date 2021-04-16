<?php

namespace App\Infra\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Type extends Constraint
{
    public $message = 'The type "{{ type }}" is not an available type. Please choose among {{ available_types }}';
}
