<?php

namespace App\Backend\Video\Business\IndexProvider;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\Video\Business\IndexProvider\Expander\VideoIndexTransferExpanderInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use App\Shared\Generated\DTO\Video\VideoIndexTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class IndexPopulateProvider implements IndexPopulateProviderInterface
{
    public function __construct(
        private readonly SearchStorageFacadeInterface $searchStorageFacade,
        private readonly VideoIndexTransferExpanderInterface $indexTransferExpander
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function populate(VideoTransfer $videoTransfer): void
    {
        $videoIndex = new VideoIndexTransfer();
        $indexAddTransfer = (new IndexAddTransfer())
            ->setIndex('video')
            ->setBody($videoIndex)
            ->setId($videoTransfer->getId());

        $this->indexTransferExpander->expand($videoIndex, $videoTransfer);
        $this->searchStorageFacade->index($indexAddTransfer);
    }
}