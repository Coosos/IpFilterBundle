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

namespace Coosos\AppIpFilterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadIpData
 *
 * @package Coosos\AppIpFilterBundle\DataFixtures\ORM
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class LoadIpData extends AbstractFixture implements FixtureInterface,
                                                    ContainerAwareInterface,
                                                    OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $ipManager = $this->container->get('sl_ip_filter.ip_manager.default');

        foreach ($this->getIps() as $ips) {
            $ip = $ipManager->hydrateModelWithIp($ips['ip']);
            $ip->setAuthorized($ips['authorized'])
               ->setEnvironment($ips['environment']);

            $ipManager->saveIp($ip);
        }
    }

    /**
     * @return array
     */
    protected function getIps()
    {
        return [
            [
                'ip'          => '192.168.1.1',
                'environment' => [],
                'authorized'  => false,
            ],
            [
                'ip'          => '192.168.1.1',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => true,
            ],
            [
                'ip'          => '192.168.1.2',
                'environment' => [],
                'authorized'  => false,
            ],
            [
                'ip'          => '192.168.1.20',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => false,
            ],
            [
                'ip'          => 'fe80::2:0',
                'environment' => [],
                'authorized'  => false,
            ],
            [
                'ip'          => 'fe80::2:0',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => true,
            ],
            [
                'ip'          => 'fe80::2:10',
                'environment' => [],
                'authorized'  => false,
            ],
            [
                'ip'          => 'fe80::2:11',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => false,
            ],
            [
                'ip'          => '10.0.0.0/24',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => false,
            ],
        ];
    }
}
