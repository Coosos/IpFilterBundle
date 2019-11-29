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

namespace Coosos\IpFilterBundle\Tool;

/**
 * Class IpConverter
 *
 * @package Coosos\IpFilterBundle\Tool
 */
class IpConverter
{
    /**
     * Convert IP to hex
     *
     * @param string $ip
     *
     * @return string
     */
    public static function fromIpToHex(string $ip): string
    {
        $hex = bin2hex(inet_pton($ip));
        if (8 === strlen($hex)) {
            $hex = str_pad($hex, 32, '0', STR_PAD_LEFT);
        }

        return $hex;
    }

    /**
     * Convert hex to ip
     *
     * @param string $ip
     *
     * @return string
     */
    public static function fromHexToIp(string $ip): string
    {
        $hex = pack('H*', $ip);
        if (str_repeat('0', 24) === substr($hex, 0, 24)) {
            $hex = substr($hex, 24);
        }

        return inet_ntop($hex);
    }
}
