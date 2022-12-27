<?php

namespace App\Backend\MediaConverter\Business\Configuration\Media;

use App\Backend\MediaConverter\Options\Converter\ResolutionVideoOptionsInterface;

class MediaResolutionsCalculatorFactory implements MediaResolutionsCalculatorFactoryInterface
{
    /**
     * @var ResolutionVideoOptionsInterface[]
     */
    private iterable $options;

    /**
     * @param ResolutionVideoOptionsInterface ...$options
     */
    public function __construct(
        ResolutionVideoOptionsInterface ...$options
    ) {
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): MediaResolutionsCalculatorInterface
    {
        return new MediaResolutionsCalculator($this->options);
    }
}
