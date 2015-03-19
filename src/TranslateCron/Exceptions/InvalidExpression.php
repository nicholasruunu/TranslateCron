<?php namespace Garbee\TranslateCron\Exceptions;

use Exception;

class InvalidExpression extends Exception
{
    protected $message = 'An invalid expression was provided.';
}
