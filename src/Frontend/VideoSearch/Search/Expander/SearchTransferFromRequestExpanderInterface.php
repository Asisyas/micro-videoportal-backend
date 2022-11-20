<?php

namespace App\Frontend\VideoSearch\Search\Expander;

use Symfony\Component\HttpFoundation\Request;

interface SearchTransferFromRequestExpanderInterface
{
    /**
     * @param Request $request
     *
     * @return void
     */
    public function expand(Request $request): void;
}