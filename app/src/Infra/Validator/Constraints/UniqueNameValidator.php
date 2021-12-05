<?php

namespace App\Infra\Validator\Constraints;

use App\Infra\Repository\PokemonRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Used to validate the {Create,Update}PokemonCommand
 * @psalm-suppress PropertyNotSetInConstructor
 * @psalm-suppress MoreSpecificImplementedParamType
 */
class UniqueNameValidator extends ConstraintValidator
{
    public function __construct(
        protected PokemonRepository $repository
    ) {
    }

    /** @param string $value */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueName) {
            throw new UnexpectedTypeException($constraint, UniqueName::class);
        }

        if (empty($value)) {
            return;
        }

        $existingNames = $this->repository->getPokemonNames();
        if (in_array($value, $existingNames)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ name }}', $value)
                ->addViolation();
        }
    }
}
