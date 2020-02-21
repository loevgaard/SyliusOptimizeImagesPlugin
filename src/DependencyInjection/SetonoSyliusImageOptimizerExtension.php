<?php

declare(strict_types=1);

namespace Setono\SyliusImageOptimizerPlugin\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SetonoSyliusImageOptimizerExtension extends Extension
{
    /**
     * @throws Exception
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $container->setParameter('setono_sylius_image_optimizer.image_resources', $config['image_resources']);
        $container->setParameter('setono_sylius_image_optimizer.kraken.key', $config['kraken']['key']);
        $container->setParameter('setono_sylius_image_optimizer.kraken.secret', $config['kraken']['secret']);

        $loader->load('services.xml');
    }
}