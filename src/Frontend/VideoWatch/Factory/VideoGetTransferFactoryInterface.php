<?php

namespace App\Frontend\VideoWatch\Factory;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Symfony\Component\HttpFoundation\Request;

interface VideoGetTransferFactoryInterface
{
    /**
     * @param Request $request
     *
     * @return VideoGetTransfer
     */
    public function create(Request $request): VideoGetTransfer;
}