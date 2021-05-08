<?php

namespace App\Infra\Validator\Constraints;

use App\Infra\Repository\TypeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Used to validate if the type exists
 */
class TypeValidator extends ConstraintValidator
{
    public function __construct(
        protected TypeRepository $repository
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Type) {
            throw new UnexpectedTypeException($constraint, Type::class);
        }

        if (empty($value)) {
            return;
        }

        $acceptedTypes = $this->repository->getTypesName();
        if (!in_array($value, $acceptedTypes)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ type }}', $value)
                ->setParameter('{{ available_types }}', implode(', ', $acceptedTypes))
                ->addViolation();
        }
    }
}
