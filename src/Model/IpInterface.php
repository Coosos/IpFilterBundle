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

/**
 * Interface IpInterface
 *
 * @package Coosos\IpFilterBundle\Model
 */
interface IpInterface
{
    /**
     * @return string
     */
    public function getStartIp();

    /**
     * @param string $startIp The start IP address
     *
     * @return self
     */
    public function setStartIp(string $startIp);

    /**
     * If null, matches only one ip (StartIp)
     *
     * @return string
     */
    public function getEndIp();

    /**
     * If null, matches only one ip (StartIp)
     *
     * @param string|null $endIp The end IP address
     *
     * @return self
     */
    public function setEndIp(?string $endIp);

    /**
     * @return array
     */
    public function getEnvironment();

    /**
     * @param array $environment The environment
     *
     * @return self
     */
    public function setEnvironment(array $environment);

    /**
     * @return bool
     */
    public function isAuthorized();

    /**
     * @param bool $authorized
     *
     * @return self
     */
    public function setAuthorized(bool $authorized);
}
