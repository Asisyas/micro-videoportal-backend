<?php

namespace App\Frontend\ActionStatus\Handler\Request;


use Micro\Plugin\Http\Handler\Request\RequestHandlerContextInterface;
use Micro\Plugin\Http\Handler\Request\RequestHandlerInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;

class TestRequestHandler implements RequestHandlerInterface
{
    public function __construct(private readonly LoggerFacadeInterface $loggerFacade)
    {

    }

    public function handle(RequestHandlerContextInterface $requestHandlerContext): void
    {
        dump('AAAAAAAAAAAAAAAAAAAA');

        $this->loggerFacade->getLogger()->debug(sprintf('Handled %s', get_class($this)) );
    }
}