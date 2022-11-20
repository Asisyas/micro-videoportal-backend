<?php

namespace App\Client\Search\Expander\SearchResults;

interface SearchResultsExpanderFactoryInterface
{
    /**
     * @return SearchResultsExpanderInterface
     */
    public function create(): SearchResultsExpanderInterface;
}