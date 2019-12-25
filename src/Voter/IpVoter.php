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

use Coosos\IpFilterBundle\Model\IpManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class IpVoter
 *
 * @package Coosos\IpFilterBundle\Voter
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class IpVoter extends AbstractIpVoter
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
     * @var IpManagerInterface
     */
    protected $ipManager;

    /**
     * IpVoter constructor.
     *
     * @param string             $environment
     * @param RequestStack       $requestStack
     * @param IpManagerInterface $ipManager
     */
    public function __construct(string $environment, RequestStack $requestStack, IpManagerInterface $ipManager)
    {
        $this->environment = $environment;
        $this->requestStack = $requestStack;
        $this->ipManager = $ipManager;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequest(): ?Request
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * {@inheritDoc}
     */
    protected function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * {@inheritDoc}
     */
    protected function getIpManager(): IpManagerInterface
    {
        return $this->ipManager;
    }
}
