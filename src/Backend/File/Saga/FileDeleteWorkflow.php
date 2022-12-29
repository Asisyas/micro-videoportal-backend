<?php

namespace App\Backend\File\Saga;

use App\Shared\File\Saga\FileActivityInterface;
use App\Shared\File\Saga\FileDeleteWorkflowInterface;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;
use Generator;

class FileDeleteWorkflow implements FileDeleteWorkflowInterface
{
    /**
     * {@inheritDoc}
     */
    public function deleteFile(FileRemoveTransfer $fileRemoveTransfer): Generator
    {
        return yield $this
            ->createFileActivity()
            ->removeFile($fileRemoveTransfer);
    }

    protected function createFileActivity(): ActivityProxy
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
