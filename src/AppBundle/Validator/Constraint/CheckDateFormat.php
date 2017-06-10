<?php

namespace AppBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckDateFormat extends Constraint
{
    public $message = 'Invalid date format';

    public function __construct($message = '')
    {
        if (!empty($message['message'])) {
            $this->message = $message['message'];
        }
    }
}
