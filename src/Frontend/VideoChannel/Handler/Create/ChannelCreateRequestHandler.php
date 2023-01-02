<?php

namespace App\Frontend\VideoChannel\Handler\Create;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\VideoChannel\Exception\ChannelIdAlreadyExistsException;
use Micro\Plugin\Http\Exception\HttpException;
use Micro\Plugin\Http\Exception\HttpUnprocessableEntityException;
use Symfony\Component\HttpFoundation\Request;
use Temporal\Exception\Failure\ApplicationFailure;

class ChannelCreateRequestHandler implements ChannelCreateRequestHandlerInterface
{
    /**
     * @param ClientVideoChannelInterface $videoChannelClient
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly ClientVideoChannelInterface $videoChannelClient,
        private readonly SecurityFacadeInterface     $securityFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function handleChannelCreateFromRequest(Request $request): VideoChannelTransfer
    {
        $ownerToken = $this->securityFacade->getAuthToken();
        $channelId = (string) $request->query->get('channel_id');

        $channelCreateTransfer = new VideoChannelCreateTransfer();
        $channelCreateTransfer
            ->setId($channelId)
            ->setOwnerId($ownerToken->getUserId())
            ->setTitle(sprintf('Channel %s owned by %s', $channelId, $ownerToken->getUserId()))
        ;

        try {
            return $this->videoChannelClient->createChannel($channelCreateTransfer);
        } catch (\Throwable $exception) {
            /**
             * @phpstan-ignore-next-line
             * @var ApplicationFailure $applicationFaillure
             */
            $applicationFailure = $exception->getPrevious()->getPrevious();
            //@phpstan-ignore-next-line
            if ($applicationFailure->getType() === ChannelIdAlreadyExistsException::class) {
                // @phpstan-ignore-next-line
                throw new HttpUnprocessableEntityException($applicationFailure->getOriginalMessage());
            }

            throw new HttpException();
        }
    }
}
