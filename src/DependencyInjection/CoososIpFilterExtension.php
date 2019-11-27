<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 * Copyright (c) 2019-2020 Coosos
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Coosos\IpFilterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\HttpKernel\Kernel;

class CoososIpFilterExtension extends Extension
{
    private $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration($this->getAlias());

        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        if ('2.4' > Kernel::VERSION) {
            $loader->load('service_2.3.xml');
        } else {
            $loader->load('service.xml');
        }

        $container->setAlias($this->getAlias().'.ip_manager', $config['ip_manager']);
        $container->setParameter($this->getAlias().'.ip.class', $config['ip_class']);

        $container->setAlias($this->getAlias().'.range_manager', $config['range_manager']);
        $container->setParameter($this->getAlias().'.range.class', $config['range_class']);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
