<?php

namespace App\Backend\ClientStorage\Saga;

use App\Shared\ClientStorage\Saga\ClientStoragePutActivityInterface;
use App\Shared\ClientStorage\Saga\ClientStoragePutWorkflowInterface;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

class ClientStoragePutWorkflow implements ClientStoragePutWorkflowInterface
{
    private readonly ActivityProxy $clientStorageActivity;

    public function __construct()
    {
        $this->clientStorageActivity = Workflow::newActivityStub(
            ClientStoragePutActivityInterface::class,
            ActivityOptions::new()
                ->withRetryOptions(
                    RetryOptions::new()
                        ->withMaximumAttempts(10)
                )
                ->withStartToCloseTimeout(CarbonInterval::minute())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function put(PutTransfer $putTransfer)
    {
        yield $this->clientStorageActivity->put($putTransfer);
    }
}