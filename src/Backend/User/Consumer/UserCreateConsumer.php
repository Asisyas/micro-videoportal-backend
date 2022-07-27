<?php

namespace App\Backend\User\Consumer;

use App\Backend\User\Facade\UserFacadeInterface;
use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\User\Configuration;
use Micro\Component\DependencyInjection\Container;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerProcessorInterface;
use Micro\Plugin\Amqp\Business\Message\MessageInterface;
use Micro\Plugin\Amqp\Business\Message\MessageReceivedInterface;

class UserCreateConsumer implements ConsumerProcessorInterface
{
    private bool $initialized = false;

    /**
     * @var SerializerFacadeInterface
     */
    private readonly SerializerFacadeInterface $serializerFacade;

    /**
     * @var UserFacadeInterface
     */
    private readonly UserFacadeInterface $userFacade;

    /**
     * @param Container $container
     */
    public function __construct(private Container $container)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function receive(MessageReceivedInterface $message): bool
    {
        try {
            $this->provideDependencies();
            $this->execute($message);
            $message->ack();

            return true;
        } catch (\Exception $e) {
            $message->content()->setResultContent($e);
            $message->nack();

            return false;
        }
    }

    /**
     * @param MessageReceivedInterface $message
     *
     * @return void
     *
     * @throws \Micro\Library\DTO\Exception\SerializeException
     * @throws \Micro\Library\DTO\Exception\UnserializeException
     */
    protected function execute(MessageReceivedInterface $message)
    {
        /** @var UserCreateTransfer $userCreateTransfer */
        $userCreateTransfer = $this->serializerFacade->fromJsonTransfer($message->content()->getContent());
        $userTransfer = $this->userFacade->createUser($userCreateTransfer);
        $message->content()->setResultContent($this->serializerFacade->toJsonTransfer($userTransfer));
    }

    /**
     * @return void
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function provideDependencies()
    {
        if($this->initialized) {
            return;
        }

        $this->serializerFacade = $this->container->get(SerializerFacadeInterface::class);
        $this->userFacade = $this->container->get(UserFacadeInterface::class);

        unset($this->container);

        $this->initialized = true;
    }

    /**
     * {@inheritDoc}
     */
    public static function name(): string
    {
        return Configuration::AMQP_CONSUMER_USER_CREATE;
    }
}