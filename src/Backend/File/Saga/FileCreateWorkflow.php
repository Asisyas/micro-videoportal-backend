<?php

namespace App\Backend\File\Saga;

use App\Shared\File\Saga\FileActivityInterface;
use App\Shared\File\Saga\FileCreateWorkflowInterface;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;
use Generator;

class FileCreateWorkflow implements FileCreateWorkflowInterface
{
    /**
     * {@inheritDoc}
     *
     * @psalm-return Generator<int, \Temporal\Internal\Transport\CompletableResultInterface, mixed, \Temporal\Internal\Transport\CompletableResultInterface|mixed>
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): Generator
    {
        return yield $this
            ->createFileActivity()
            ->createFile($fileUploadTransfer);
    }

    protected function createFileActivity(): FileActivityInterface
    {
        // @phpstan-ignore-next-line
        return Workflow::newActivityStub(
            FileActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::minute())
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(5)
                )
        );
    }
}
