<?php

namespace App\Backend\VideoConverter\Business\Configuration\Video;

use App\Backend\VideoConverter\Options\Converter\ResolutionVideoOptionsInterface;

class VideoResolutionsCalculatorFactory implements VideoResolutionsCalculatorFactoryInterface
{
    /**
     * @var ResolutionVideoOptionsInterface[]
     */
    private iterable $options;

    public function __construct(
        ResolutionVideoOptionsInterface ...$options
    )
    {

        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoResolutionsCalculatorInterface
    {
        return new VideoResolutionsCalculator($this->options);
    }
}