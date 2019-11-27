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

interface RangeManagerInterface
{
    /**
     * @param string $network The network with CIDR (e.g. 0.0.0.0/0, 192.168.0.0/24, fe80::/64)
     *
     * @return \Coosos\IpFilterBundle\Model\RangeInterface
     */
    public function createRangeFromNetwork($network);

    /**
     * @param string $ip
     * @param string $environment
     *
     * @return \Coosos\IpFilterBundle\Model\RangeInterface[]
     */
    public function findByIpAddress($ip, $environment);

    /**
     * @return \Coosos\IpFilterBundle\Model\RangeInterface
     */
    public function createRange();

    /**
     * @param \Coosos\IpFilterBundle\Model\RangeInterface $range
     *
     * @return self
     */
    public function saveRange(RangeInterface $range);

    /**
     * @param \Coosos\IpFilterBundle\Model\RangeInterface $range
     *
     * @return self
     */
    public function deleteRange(RangeInterface $range);
}
