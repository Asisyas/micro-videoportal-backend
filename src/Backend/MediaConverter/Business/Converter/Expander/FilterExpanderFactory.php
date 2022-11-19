<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander;

class FilterExpanderFactory implements FilterExpanderFactoryInterface
{
    /**
     * @var iterable<FilterExpanderInterface>
     */
    private iterable $filterExpanderCollection;

    /**
     * @param FilterExpanderInterface ...$filterExpanderCollection
     */
    public function __construct(FilterExpanderInterface ...$filterExpanderCollection)
    {

        $this->filterExpanderCollection = $filterExpanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): FilterExpanderInterface
    {
        return new FilterExpander($this->filterExpanderCollection);
    }
}