<?php

namespace App\Frontend\Common\ResponseTransformer;

use Micro\Plugin\Http\Handler\Response\ResponseHandlerContextInterface;
use Micro\Plugin\Http\Handler\Response\ResponseHandlerInterface;
use Temporal\Exception\Client\WorkflowFailedException;
use Temporal\Exception\Failure\ActivityFailure;
use Temporal\Exception\Failure\ApplicationFailure;

class TemporalExceptionHandler implements ResponseHandlerInterface
{
    /**
     * {@inheritDoc}
     */
    public function handle(ResponseHandlerContextInterface $responseHandlerContext): void
    {
        $exception = $responseHandlerContext->getException();
        if(!$exception || !($exception instanceof WorkflowFailedException)) {
            return;
        }

        /** @var ActivityFailure $activityFailure */
        $activityFailure = $exception->getPrevious();
        /** @var ApplicationFailure $appFailed */
        $appFailed = $activityFailure->getPrevious();

        $exceptionClass = $appFailed->getType();
        if(!class_exists($exceptionClass)) {
            return;
        }

        $responseHandlerContext->setException(
            new $exceptionClass(
                $appFailed->getOriginalMessage()
            )
        );
    }
}