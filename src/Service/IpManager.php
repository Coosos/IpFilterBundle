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

namespace Coosos\IpFilterBundle\Service;

use Coosos\IpFilterBundle\Model\IpInterface;
use Coosos\IpFilterBundle\Model\IpManagerInterface;
use Coosos\IpFilterBundle\Repository\IpRepository;
use Coosos\IpFilterBundle\Tool\Network;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\Persistence\AbstractManagerRegistry;
use Exception;

/**
 * Class IpManager
 *
 * @package Coosos\IpFilterBundle\Model
 */
class IpManager implements IpManagerInterface
{
    /**
     * @var ObjectManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var ObjectRepository|IpRepository
     */
    protected $entityRepository;

    /**
     * IpManager constructor.
     *
     * @param AbstractManagerRegistry $registry
     * @param string                  $class
     */
    public function __construct(AbstractManagerRegistry $registry, string $class)
    {
        $this->class = $class;
        $this->entityManager = $registry->getManagerForClass($class);
        $this->entityRepository = $this->entityManager->getRepository($class);
    }

    /**
     * {@inheritdoc}
     */
    public function findIpAddress($ip, $environment)
    {
        return $this->entityRepository->findIpAddress($ip, $environment);
    }

    /**
     * {@inheritdoc}
     */
    public function createIp()
    {
        $class = $this->class;

        return new $class();
    }

    /**
     * {@inheritdoc}
     */
    public function saveIp(IpInterface $ip, bool $autoFlush = true)
    {
        $this->entityManager->persist($ip);
        if ($autoFlush) {
            $this->entityManager->flush();
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteIp(IpInterface $ip, bool $autoFlush = true)
    {
        $this->entityManager->remove($ip);
        if ($autoFlush) {
            $this->entityManager->flush();
        }

        return $this;
    }

    /**
     * Hydrate model with ip string (Allow subnetwork in string)
     *
     * @param string           $ip
     * @param IpInterface|null $model
     *
     * @return IpInterface
     * @throws Exception
     */
    public function hydrateModelWithIp(string $ip, IpInterface $model = null): IpInterface
    {
        $model = $model ?? $this->createIp();
        $startIp = $ip;
        $endIp = null;
        if (strpos($ip, '/') !== false) {
            $values = Network::getRange($ip);
            $startIp = $values['start'];
            $endIp = $values['end'];
        }

        return $model->setStartIp($startIp)->setEndIp($endIp);
    }
}
