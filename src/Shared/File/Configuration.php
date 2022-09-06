<?php

namespace App\Shared\File;

interface Configuration
{
    public const PUBLISHER_FILE_CREATE_NAME = 'file_create';

    public const CONSUMER_FILE_CREATE_NAME = self::PUBLISHER_FILE_CREATE_NAME;

    public const CLIENT_STORAGE_STREAM_IDX = 'file_stream';

    public const CLIENT_STORAGE_FILE_IDX = 'file';
}