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

use Coosos\IpFilterBundle\Model\IpManagerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadRangeData
 *
 * @package Coosos\AppIpFilterBundle\DataFixtures\ORM
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class LoadRangeData extends AbstractFixture implements
    FixtureInterface,
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
     */
    public function load(ObjectManager $manager)
    {
        /** @var IpManagerInterface $ipManager */
        $ipManager = $this->container->get('sl_ip_filter.ip_manager');

        foreach ($this->getRanges() as $ranges) {
            $ip = $ipManager->createIp();
            $ip->setStartIp($ranges['start_ip'])
                ->setEndIp($ranges['end_ip'])
                ->setAuthorized($ranges['authorized'])
                ->setEnvironment($ranges['environment']);

            $ipManager->saveIp($ip);
        }
    }

    /**
     * @return array
     */
    protected function getRanges()
    {
        return [
            [
                'start_ip'    => '192.168.2.1',
                'end_ip'      => '192.168.2.100',
                'environment' => [],
                'authorized'  => true,
            ],
            [
                'start_ip'    => '192.168.2.101',
                'end_ip'      => '192.168.2.200',
                'environment' => [],
                'authorized'  => false,
            ],
            [
                'start_ip'    => '192.168.2.120',
                'end_ip'      => '192.168.2.121',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => true,
            ],
            [
                'start_ip'    => 'fe80::0',
                'end_ip'      => 'fe80::ff',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => false,
            ],
            [
                'start_ip'    => 'fe80::fa',
                'end_ip'      => 'fe80::fb',
                'environment' => ['test', 'prod', 'dev'],
                'authorized'  => true,
            ],
        ];
    }
}
