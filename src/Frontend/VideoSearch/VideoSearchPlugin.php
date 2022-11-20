<?php

namespace App\Frontend\VideoSearch;

use App\Client\Search\Client\SearchClientInterface;
use App\Frontend\VideoSearch\Facade\VideoSearchFacade;
use App\Frontend\VideoSearch\Facade\VideoSearchFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoSearchPlugin extends AbstractPlugin
{
    private readonly SearchClientInterface $searchClient;

    public function provideDependencies(Container $container): void
    {
        $container->register(VideoSearchFacadeInterface::class, function (
            SearchClientInterface $searchClient
        ) {
            $this->searchClient = $searchClient;

            return $this->createFacade();
        });
    }

    protected function createFacade(): VideoSearchFacadeInterface
    {
        return new VideoSearchFacade(
            $this->searchClient
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoSearchPluginFrontend';
    }
}