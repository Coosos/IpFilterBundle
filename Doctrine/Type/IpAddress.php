<?php

namespace Spomky\IpFilterBundle\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
* Type that maps an Ip Address SQL to php objects
* @author Florent Morselli
*/
class IpAddress extends Type
{
    const IPADDRESS = 'ipaddress';

    public function getName()
    {
        return self::IPADDRESS;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        switch ($platform->getName()) {
            case 'sqlite':
            case 'drizzle':
            case 'db2':
                return $platform->getDoctrineTypeMapping('VARCHAR');
            case 'oracle':
                return $platform->getDoctrineTypeMapping('BLOB');
            case 'mysql':
            case 'sqlanywhere':
            case 'mssql':
                return $platform->getDoctrineTypeMapping('VARBINARY');
            case 'postgresql':
                return $platform->getDoctrineTypeMapping('BYTEA');
            default:
                throw new \Exception("Database platform '".$platform->getName()."' not supported.");
        }
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return ($value === null) ? null : bin2hex(inet_pton($value));
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if( function_exists('hex2bin') ) {
            // PHP 5.4+
            return ($value === null) ? null : hex2bin($value);
        }

        return ($value === null) ? null : inet_ntop(pack("H*",$value));
    }
}