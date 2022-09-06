<?php

namespace App\Backend\File\Model;

interface StreamInterface
{
    /**
     * @return string
     */
    public function getId(): string;

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
}