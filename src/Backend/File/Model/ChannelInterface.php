<?php

namespace App\Backend\File\Model;

interface ChannelInterface
{
    /**
     * @return string
     */
    public function getUuid(): string;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @return int
     */
    public function getChunkSize(): int;

    /**
     * @return int
     */
    public function getChunkCount(): int;

    /**
     * @return string
     */
    public function getCrc32(): string;
}