<?php

namespace App\Exceptions;

use InvalidArgumentException;

class TooManyImagesException extends InvalidArgumentException
{
    protected $message = 'Too many images were set.';
}
