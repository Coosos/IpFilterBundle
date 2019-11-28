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
 * Interface IpManagerInterface
 *
 * @package Coosos\IpFilterBundle\Model
 */
interface IpManagerInterface
{
    /**
     * Find ip address
     *
     * @param string $ip
     * @param string $environment
     *
     * @return Ip[]
     */
    public function findIpAddress($ip, $environment);

    /**
     * Create ip model
     *
     * @return IpInterface
     */
    public function createIp();

    /**
     * Save ip model
     *
     * @param IpInterface $ip
     * @param bool        $autoFlush
     *
     * @return self
     */
    public function saveIp(IpInterface $ip, bool $autoFlush);

    /**
     * Delete ip model
     *
     * @param IpInterface $ip
     * @param bool        $autoFlush
     *
     * @return self
     */
    public function deleteIp(IpInterface $ip, bool $autoFlush);

    /**
     * Hydrate model with IP
     *
     * @param string           $ip
     * @param IpInterface|null $model
     *
     * @return IpInterface
     */
    public function hydrateModelWithIp(string $ip, IpInterface $model = null): IpInterface;
}
