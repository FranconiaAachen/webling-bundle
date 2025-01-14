<?php

declare(strict_types=1);

namespace Terminal42\WeblingBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class Terminal42WeblingBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->scalarNode('subdomain')
            ->isRequired()
            ->cannotBeEmpty()
            ->defaultValue('%env(WEBLING_SUBDOMAIN)%')
            ->end()
            ->scalarNode('api_key')
            ->isRequired()
            ->cannotBeEmpty()
            ->defaultValue('%env(WEBLING_API_KEY)%')
            ->end()
            ->scalarNode('entity_factory')
            ->cannotBeEmpty()
            ->defaultValue('Terminal42\WeblingApi\EntityFactory')
            ->end()
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');

        $builder->setParameter('terminal42_webling.subdomain', $config['subdomain']);
        $builder->setParameter('terminal42_webling.api_key', $config['api_key']);
        $builder->setParameter('terminal42_webling.entity_factory', $config['entity_factory']);
    }
}
