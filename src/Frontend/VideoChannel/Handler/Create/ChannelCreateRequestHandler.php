<?php

namespace App\Frontend\VideoChannel\Handler\Create;

use App\Client\VideoChannel\Client\VideoChannelClientInterface;
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
     * @param VideoChannelClientInterface $videoChannelClient
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly VideoChannelClientInterface $videoChannelClient,
        private readonly SecurityFacadeInterface $securityFacade
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function handleChannelCreateFromRequest(Request $request): VideoChannelTransfer
    {
        $ownerToken = $this->securityFacade->getAuthToken();
        $channelId = $request->query->get('channel_id');

        $channelCreateTransfer = new VideoChannelCreateTransfer();
        $channelCreateTransfer
            ->setId($channelId)
            ->setOwnerId($ownerToken->getUserId())
            ->setTitle(sprintf('Channel %s owned by %s', $channelId, $ownerToken->getUserId()))
        ;

        try {
            return $this->videoChannelClient->createChannel($channelCreateTransfer);
        } catch (\Throwable $exception) {
            /** @var ApplicationFailure $applicationFaillure */
            $applicationFailure = $exception->getPrevious()->getPrevious();
            if($applicationFailure->getType() === ChannelIdAlreadyExistsException::class) {
                throw new HttpUnprocessableEntityException($applicationFailure->getOriginalMessage());
            }

            throw new HttpException();
        }
    }
}