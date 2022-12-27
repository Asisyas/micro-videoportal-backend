<?php

namespace App\Shared\VideoChannel\Exception;

use App\Shared\Common\Exception\UniqueConstraintException;

class ChannelIdAlreadyExistsException extends UniqueConstraintException
{
}
