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

interface IpManagerInterface
{
    /**
     * @param string $ip
     * @param string $environment
     *
     * @return \Coosos\IpFilterBundle\Model\Ip[]
     */
    public function findIpAddress($ip, $environment);

    /**
     * @return \Coosos\IpFilterBundle\Model\IpInterface
     */
    public function createIp();

    /**
     * @param \Coosos\IpFilterBundle\Model\IpInterface $ip
     *
     * @return self
     */
    public function saveIp(IpInterface $ip);

    /**
     * @param \Coosos\IpFilterBundle\Model\IpInterface $ip
     *
     * @return self
     */
    public function deleteIp(IpInterface $ip);
}
