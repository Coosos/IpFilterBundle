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
use Coosos\IpFilterBundle\Tool\IpConverter;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * Class AbstractIpVoter
 *
 * @package Coosos\IpFilterBundle\Voter
 */
abstract class AbstractIpVoter implements VoterInterface
{
    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $request = $this->getRequest();
        if (!$request) {
            throw new Exception('No request found.');
        }

        $from = IpConverter::fromIpToHex($request->getClientIp());
        $env = $this->getEnvironment();

        $ips = $this->getIpManager()->findIpAddress($from, $env);
        if (count($ips) === 0) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        foreach ($ips as $ip) {
            if ($ip->isAuthorized()) {
                return VoterInterface::ACCESS_GRANTED;
            }
        }

        return VoterInterface::ACCESS_DENIED;
    }

    /**
     * @return Request
     */
    abstract protected function getRequest(): ?Request;

    /**
     * @return string
     */
    abstract protected function getEnvironment(): string;

    /**
     * @return IpManagerInterface
     */
    abstract protected function getIpManager(): IpManagerInterface;
}
