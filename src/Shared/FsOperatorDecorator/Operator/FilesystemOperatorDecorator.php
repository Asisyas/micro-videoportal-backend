<?php

namespace App\Shared\FsOperatorDecorator\Operator;

use DateTimeInterface;
use League\Flysystem\DirectoryListing;
use League\Flysystem\FilesystemOperator;

class FilesystemOperatorDecorator implements FilesystemOperator
{
    /**
     * @param FilesystemOperator $fsOperator
     */
    public function __construct(
        private readonly FilesystemOperator $fsOperator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function fileExists(string $location): bool
    {
        return $this->fsOperator->fileExists($this->getFilePrefix($location));
    }

    /**
     * {@inheritDoc}
     */
    public function directoryExists(string $location): bool
    {
        return $this->fsOperator->directoryExists($location);
    }

    /**
     * {@inheritDoc}
     */
    public function write(string $location, string $contents, array $config = []): void
    {
        $this->fsOperator->write($this->getFilePrefix($location), $contents, $config);
    }

    /**
     * {@inheritDoc}
     */
    public function writeStream(string $location, $contents, array $config = []): void
    {
        $this->fsOperator->writeStream($this->getFilePrefix($location), $contents, $config);
    }

    /**
     * {@inheritDoc}
     */
    public function read(string $location): string
    {
        return $this->fsOperator->read($this->getFilePrefix($location));
    }

    /**
     * {@inheritDoc}
     */
    public function readStream(string $location)
    {
        return $this->fsOperator->readStream($this->getFilePrefix($location));
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $location): void
    {
        $this->fsOperator->delete($this->getFilePrefix($location));
    }

    /**
     * {@inheritDoc}
     */
    public function deleteDirectory(string $location): void
    {
        $this->fsOperator->deleteDirectory($location);
    }

    /**
     * {@inheritDoc}
     */
    public function createDirectory(string $location, array $config = []): void
    {
        $this->fsOperator->createDirectory($location, $config);
    }

    /**
     * {@inheritDoc}
     */
    public function setVisibility(string $path, string $visibility): void
    {
        $this->fsOperator->setVisibility($path, $visibility);
    }

    /**
     * {@inheritDoc}
     */
    public function visibility(string $path): string
    {
        return $this->fsOperator->visibility($path);
    }

    /**
     * {@inheritDoc}
     */
    public function mimeType(string $path): string
    {
        return $this->fsOperator->mimeType($this->getFilePrefix($path));
    }

    /**
     * {@inheritDoc}
     */
    public function lastModified(string $path): int
    {
        return $this->fsOperator->lastModified($this->getFilePrefix($path));
    }

    /**
     * {@inheritDoc}
     */
    public function fileSize(string $path): int
    {
        return $this->fsOperator->fileSize($this->getFilePrefix($path));
    }

    /**
     * {@inheritDoc}
     */
    public function listContents(string $location, bool $deep = self::LIST_SHALLOW): DirectoryListing
    {
        return $this->fsOperator->listContents($location, $deep);
    }

    /**
     * {@inheritDoc}
     */
    public function move(string $source, string $destination, array $config = []): void
    {
        $this->fsOperator->move(
            $this->getFilePrefix($source),
            $this->getFilePrefix($destination),
            $config
        );
    }

    /**
     * {@inheritDoc}
     */
    public function copy(string $source, string $destination, array $config = []): void
    {
        $this->fsOperator->copy(
            $this->getFilePrefix($source),
            $this->getFilePrefix($destination),
            $config
        );
    }

    /**
     * {@inheritDoc}
     */
    public function publicUrl(string $location, array $config = []): string
    {
        return $this->fsOperator->publicUrl($this->getFilePrefix($location), $config);
    }

    /**
     * {@inheritDoc}
     */
    public function temporaryUrl(string $location, DateTimeInterface $expiresAt, array $config = []): string
    {
        return $this->fsOperator->temporaryUrl($this->getFilePrefix($location), $expiresAt, $config);
    }

    /**
     * @param string $source
     *
     * @return string
     */
    protected function getFilePrefix(string $source): string
    {
        $separator = '.';
        $exploded = explode($separator, $source);
        $prefix = $source;
        if (count($exploded) > 1) {
            $prefix = $exploded[0];
        }

        return sprintf('%s/%s', $prefix, $source);
    }

    /**
     * {@inheritDoc}
     */
    public function __call(string $name, array $arguments) // @phpstan-ignore-line
    {
        return $this->fsOperator->{$name}(...$arguments);
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $location): bool
    {
        return $this->fsOperator->has($this->getFilePrefix($location));
    }
}
