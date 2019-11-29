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

namespace Coosos\IpFilterBundle;

use Coosos\IpFilterBundle\DependencyInjection\CoososIpFilterExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CoososIpFilterBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new CoososIpFilterExtension('sl_ip_filter');
    }
}
