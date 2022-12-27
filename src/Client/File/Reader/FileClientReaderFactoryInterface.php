<?php

namespace App\Client\File\Reader;

interface FileClientReaderFactoryInterface
{
    /**
     * @return FileClientReaderInterface
     */
    public function create(): FileClientReaderInterface;
}
