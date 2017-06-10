<?php

namespace AppBundle\Validator\Constraint;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckDateFormatValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (self::checkDatetimeFormat($value)) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }

    public function checkDatetimeFormat($datetime)
    {
        if (!self::validateDate($datetime)) {
            return true;
        }

        return false;
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        try {
            \DateTime::createFromFormat($format, $date);
            $info = \DateTime::getLastErrors();
        } catch (Exception $e) {
            return false;
        }

        return !$info['errors'] && !$info['warnings'];
    }
}
