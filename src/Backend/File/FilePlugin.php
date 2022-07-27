<?php

namespace App\Backend\File;

use App\Backend\File\Business\Channel\Expander\CredentialsResponse\CredentialsResponseExpanderFactory;
use App\Backend\File\Business\Channel\Expander\CredentialsResponse\CredentialsResponseExpanderFactoryInterface;
use App\Backend\File\Business\Channel\Expander\CredentialsResponse\Expander\BaseExpander;
use App\Backend\File\Business\Channel\Expander\CredentialsResponse\Expander\ExpanderInterface;
use App\Backend\File\Business\Channel\Factory\ChannelFactory;
use App\Backend\File\Business\Channel\Factory\ChannelFactoryInterface;
use App\Backend\File\Facade\FileFacade;
use App\Backend\File\Facade\FileFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class FilePlugin extends AbstractPlugin
{
    public function provideDependencies(Container $container): void
    {
        $container->register(FileFacadeInterface::class, function (
            UuidFacadeInterface $uuidFacade,
            DoctrineFacadeInterface $doctrineFacade
        ) {
            return $this->createFacade($uuidFacade, $doctrineFacade);
        });
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     *
     * @return FileFacadeInterface
     */
    protected function createFacade(UuidFacadeInterface $uuidFacade, DoctrineFacadeInterface $doctrineFacade): FileFacadeInterface
    {
        $channelFactory = $this->createChannelFactory(
            $uuidFacade,
            $doctrineFacade
        );

        return new FileFacade($channelFactory);
    }

    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     *
     * @return ChannelFactoryInterface
     */
    protected function createChannelFactory(UuidFacadeInterface $uuidFacade, DoctrineFacadeInterface $doctrineFacade): ChannelFactoryInterface
    {
        $credentialsResponseExpanderFactory = $this->createCredentialsResponseExpanderFactory();

        return new ChannelFactory(
            $uuidFacade,
            $doctrineFacade,
            $credentialsResponseExpanderFactory
        );
    }

    /**
     * @return iterable<ExpanderInterface>
     */
    protected function createCredentialsResponseExpanderIterator(): iterable
    {
        return [
            new BaseExpander()
        ];
    }

    /**
     * @return CredentialsResponseExpanderFactoryInterface
     */
    protected function createCredentialsResponseExpanderFactory(): CredentialsResponseExpanderFactoryInterface
    {
        return new CredentialsResponseExpanderFactory(
            $this->createCredentialsResponseExpanderIterator()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginBackend';
    }
}