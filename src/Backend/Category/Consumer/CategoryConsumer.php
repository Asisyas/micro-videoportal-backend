<?php

namespace App\Backend\Category\Consumer;

use App\Shared\Category\Configuration;
use App\Shared\Category\Facade\CategoryFacadeInterface;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use Micro\Component\DependencyInjection\Container;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerProcessorInterface;
use Micro\Plugin\Amqp\Business\Message\MessageReceivedInterface;

class CategoryConsumer implements ConsumerProcessorInterface
{
    /**
     * @var CategoryFacadeInterface|null
     */
    private ?CategoryFacadeInterface $categoryFacade = null;

    /**
     * @var SerializerFacadeInterface|null
     */
    private ?SerializerFacadeInterface  $serializerFacade = null;

    /**
     * @var Container|null
     */
    private ?Container $container = null;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function receive(MessageReceivedInterface $message): bool
    {
        $this->provideDependencies();

        $content = $message->content();
        try {
            /** @var CategoryCreateTransfer $messageTransfer */
            $messageTransfer = $this->serializerFacade->fromJsonTransfer($content->getContent());
            $categoryTransfer = $this->categoryFacade->createCategory($messageTransfer);
            $message->content()->setResultContent($this->serializerFacade->toJsonTransfer($categoryTransfer));
        } catch (\Throwable $exception) {
            $message->content()->setResultContent($exception->getMessage());

            $message->nack();

            return false;
        }

        $message->ack();

        return true;
    }

    /**
     * @return CategoryFacadeInterface
     */
    protected function provideDependencies(): CategoryFacadeInterface
    {
        if(!$this->categoryFacade) {
            $this->categoryFacade = $this->container->get(Configuration::SERVICE_FACADE_BACKEND);
            $this->serializerFacade = $this->container->get(SerializerFacadeInterface::class);

            unset($this->container);
        }

        return $this->categoryFacade;
    }

    /**
     * {@inheritDoc}
     */
    public static function name(): string
    {
        return Configuration::AMQP_CONSUMER_CATEGORY;
    }
}