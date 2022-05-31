<?php

namespace App\Backend\Category\Consumer;

use App\Shared\Category\Configuration;
use App\Shared\Category\Facade\CategoryFacadeInterface;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use Micro\Component\DependencyInjection\Container;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerProcessorInterface;
use Micro\Plugin\Amqp\Business\Message\MessageReceivedInterface;

class CategoryConsumer implements ConsumerProcessorInterface
{
    /**
     * @var CategoryFacadeInterface|null
     */
    private ?CategoryFacadeInterface $categoryFacade = null;

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
        $content = $message->content();
        /** @var CategoryCreateTransfer $messageTransfer */
        $messageTransfer = unserialize($content->getContent());

        $categoryTransfer = $this->getCategoryFacade()->createCategory($messageTransfer);

        $message->content()->setResultContent(serialize($categoryTransfer));

        $message->ack();

        return true;
    }

    /**
     * @return CategoryFacadeInterface
     */
    protected function getCategoryFacade(): CategoryFacadeInterface
    {
        if(!$this->categoryFacade) {
            $this->categoryFacade = $this->container->get(Configuration::SERVICE_FACADE_BACKEND);

            unset($this->container);
        }

        return $this->categoryFacade;
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return Configuration::AMQP_CONSUMER_CATEGORY;
    }
}