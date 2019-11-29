<?php

namespace Coosos\IpFilterBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class IpRepository
 *
 * @package Coosos\IpFilterBundle\Repository
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class IpRepository extends EntityRepository
{
    /**
     * Find ip address
     *
     * @param string $ip
     * @param string $environment
     *
     * @return array
     */
    public function findIpAddress(string $ip, string $environment): array
    {
        $queryBuilder = $this->createQueryBuilder('r');
        $queryBuilder
            ->where('r.startIp = :ip OR (r.startIp <= :ip AND  r.endIp >= :ip)')
            ->andWhere("r.environment LIKE :environment OR r.environment='a:0:{}'")
            ->orderBy('r.authorized', 'DESC')
            ->setParameter('ip', $ip)
            ->setParameter('environment', '%'. $environment .'%');

        $result = $queryBuilder->getQuery()->getResult();

        return $result ?? [];
    }
}
