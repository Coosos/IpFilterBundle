<?php

namespace Coosos\TestIpFilterBundle;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class RequestTest
 *
 * @package Coosos\TestIpFilterBundle
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class RequestTest extends WebTestCase
{
    /**
     * @dataProvider requestTestList()
     *
     * @param string $clientIp
     * @param int $resultStatusCode
     */
    public function testRequest(string $clientIp, int $resultStatusCode)
    {
        $client = self::createClient([], ['REMOTE_ADDR' => $clientIp]);
        $client->followRedirects(true);
        $client->catchExceptions(false);

        if ($resultStatusCode === 401) {
            $this->expectException(AccessDeniedException::class);
        }

        $client->request('GET', '/');
        $this->assertEquals($resultStatusCode, $client->getResponse()->getStatusCode());
    }

    /**
     * @return Generator
     */
    public function requestTestList()
    {
        yield ['192.168.1.20', 401];
        yield ['fe80::2:0', 200];
        yield ['192.168.1.12', 200];
        yield ['192.168.1.22', 200];
        yield ['192.168.2.110', 401];
        yield ['192.168.2.99', 200];
        yield ['fe80::1', 401];
        yield ['fe80::fa', 200];
        yield ['10.0.0.50', 401];
    }
}
