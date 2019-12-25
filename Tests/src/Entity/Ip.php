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

namespace Coosos\AppIpFilterBundle\Entity;

use Coosos\IpFilterBundle\Entity\Ip as Base;

/**
 * Class Ip
 *
 * @package Coosos\AppIpFilterBundle\Entity
 */
class Ip extends Base
{
    /**
     * @var null|int
     */
    protected $id;

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
