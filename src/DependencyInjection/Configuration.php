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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Coosos\IpFilterBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder($this->alias);
        $rootNode = (method_exists($treeBuilder, 'getRootNode'))
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root($this->alias);

        $rootNode
            ->children()
                ->scalarNode('ip_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('ip_manager')->defaultValue('sl_ip_filter.ip_manager.default')->end()
            ->end();

        return $treeBuilder;
    }
}
