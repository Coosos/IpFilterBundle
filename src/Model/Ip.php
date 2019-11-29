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

namespace Coosos\IpFilterBundle\Model;

use Coosos\IpFilterBundle\Tool\IpConverter;

/**
 * Class Ip
 *
 * @package Coosos\IpFilterBundle\Model
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class Ip implements IpInterface
{
    /**
     * @var string
     */
    protected $startIp;

    /**
     * @var string|null
     */
    protected $endIp;

    /**
     * @var array
     */
    protected $environment = [];

    /**
     * @var bool
     */
    protected $authorized;

    /**
     * @inheritDoc
     */
    public function getStartIp()
    {
        return IpConverter::fromHexToIp($this->startIp);
    }

    /**
     * @inheritDoc
     */
    public function setStartIp(string $startIp)
    {
        $this->startIp = IpConverter::fromIpToHex($startIp);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEndIp()
    {
        return IpConverter::fromHexToIp($this->endIp);
    }

    /**
     * @inheritDoc
     */
    public function setEndIp(?string $endIp)
    {
        $this->endIp = IpConverter::fromIpToHex($endIp);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @inheritDoc
     */
    public function setEnvironment(array $environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isAuthorized()
    {
        return $this->authorized;
    }

    /**
     * @inheritDoc
     */
    public function setAuthorized(bool $authorized)
    {
        $this->authorized = $authorized;

        return $this;
    }
}
