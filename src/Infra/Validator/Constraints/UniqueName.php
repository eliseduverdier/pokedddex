<?php

namespace App\Infra\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueName extends Constraint
{
    public string $message = 'The name "{{ name }}" already exists';
}
