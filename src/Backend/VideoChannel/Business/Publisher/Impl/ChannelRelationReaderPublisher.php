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

namespace App\Backend\VideoChannel\Business\Publisher\Impl;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\VideoChannel\Business\Publisher\TransferPublisherInterface;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelOwnerRelationTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Constants;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ChannelRelationReaderPublisher implements TransferPublisherInterface
{
    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(
        private readonly ClientStorageFacadeInterface $clientStorageFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function publish(VideoChannelTransfer $videoChannelTransfer): void
    {
        $ownerId = $videoChannelTransfer->getOwnerId();

        $transfer =  new VideoChannelGetTransfer();
        $transfer
            ->setChannelId($videoChannelTransfer->getId());

        $this->clientStorageFacade->put(
            (new PutTransfer())
                ->setIndex(Constants::STORAGE_IDX_CHANNEL_BY_USER)
                ->setUuid($ownerId)
                ->setData($transfer)
        );
    }
}
