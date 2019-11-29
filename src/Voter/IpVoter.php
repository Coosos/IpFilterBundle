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

namespace Coosos\IpFilterBundle\Voter;

use Coosos\IpFilterBundle\Repository\IpRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class IpVoter
 *
 * @package Coosos\IpFilterBundle\Voter
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class IpVoter extends BaseIpVoter
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var IpRepository
     */
    private $ipRepository;

    /**
     * IpVoter constructor.
     *
     * @param string       $environment
     * @param RequestStack $requestStack
     * @param EntityRepository|IpRepository $ipRepository
     */
    public function __construct(string $environment, RequestStack $requestStack, EntityRepository $ipRepository)
    {
        $this->environment = $environment;
        $this->requestStack = $requestStack;
        $this->ipRepository = $ipRepository;
    }

    /**
     * @return Request|null
     */
    protected function getRequest()
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * @return string
     */
    protected function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return IpRepository
     */
    public function getIpRepository()
    {
        return $this->ipRepository;
    }
}
