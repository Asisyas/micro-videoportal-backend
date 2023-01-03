<?php

namespace App\Client\Search\Expander\SearchResults\Video;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Search\Expander\SearchResults\SearchResultsExpanderInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Facade\VideoTransferExpanderFacadeInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Search\ResultTransfer;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class TemporaryExpander implements SearchResultsExpanderInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param VideoTransferExpanderFacadeInterface $videoTransferExpanderFacade
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly VideoTransferExpanderFacadeInterface $videoTransferExpanderFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(SearchResultCollectionTransfer $resultCollectionTransfer, array $elasticSource): void
    {
        $resultCollectionTransfer->setTotal((int)($elasticSource['hits']['total']['value'] ?? 0));
        $hits = $elasticSource['hits']['hits'] ?? [];
        foreach ($hits as $hit) {
            $id = $hit['_id'];
            $index = $hit['_index'];

            $result = $this->clientReaderFacade->lookup(
                (new RequestTransfer())
                    ->setUuid($id)
                    ->setIndex($index)
            );

            $transfer = $result->getData();

            if ($index === 'video') {
                /** @var VideoTransfer $transfer */
                $this->videoTransferExpanderFacade->expand($transfer);
            }

            $resultCollectionTransfer->setResults(
                [(new ResultTransfer())
                    ->setSource($transfer)
                    ->setType($index)]
            );
        }
    }
}
