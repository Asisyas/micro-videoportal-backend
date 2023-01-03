<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderDescription\Expander;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\VideoDescription\Constants;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoDescriptionExpander implements VideoTransferExpanderInterface
{
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoTransfer $videoTransfer): void
    {
        $requestTransfer = new RequestTransfer();
        $requestTransfer
            ->setIndex(Constants::STORAGE_IDX)
            ->setUuid($videoTransfer->getId());

        $response = $this->clientReaderFacade->lookup($requestTransfer);
        /** @var VideoDescriptionTransfer $descriptionTransfer */
        $descriptionTransfer = $response->getData();

        $videoTransfer
            ->setDescription($descriptionTransfer->getDescription())
            ->setTitle($descriptionTransfer->getTitle());
    }
}
