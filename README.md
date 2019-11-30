# IpFilterBundle

*Note : This project was forked from [Spomky-Labs/IpFilterBundle](https://github.com/Spomky-Labs/IpFilterBundle) because is abandoned.*

[![Build Status](https://travis-ci.com/Coosos/IpFilterBundle.svg?branch=master)](https://travis-ci.org/Coosos/IpFilterBundle)

## Description
This bundle will help you to restrict access of your application using `IP addresses` and `ranges of IP addresses`.

It supports both `IPv4` and `IPv6` addresses and multiple environments.

For example, you can grant access of a range of addresses from `192.168.1.1` to `192.168.1.100` on `dev` and `test` environments and deny all others.

**Please note that this bundle has bad results in term of performance compared to similar functionality offered by a `.htaccess` file for example.** 

## This bundle required or used

| Package       | Version      |
| ------------- | ------------ |
| PHP           | ^7.1         |
| Symfony       | ^4.0         |
| Doctrine      | ^2.6         |

# Policy #

Please note that authorized IPs have a higher priority than unauthorized ones.
For example, if range `192.168.1.10` to `192.168.1.100` is **unauthorized** and `192.168.1.20` is **authorized**, then `192.168.1.20` will be granted. 

# Installation #

Installation is a quick 4 steps process:

* Download the bundle
* Enable the Bundle
* Create your model class
* Configure the application

##Step 1: Install the bundle##

The preferred way to install this bundle is to rely on Composer:

```sh
composer require "coosos/ip-filter-bundle" "~4.0"
```

##Step 2: Enable the bundle##

Enable the bundle in ``config/bundles.php``:

```php
<?php
// config/bundles.php

return [
    // .....
    Coosos\IpFilterBundle\CoososIpFilterBundle::class => ['all' => true]
    // .....
];

```

##Step 3: Create IP classes##

This bundle needs a database to persist filtered IPs.

Your first job, then, is to create `Ip` classes for your application.
These classes can look and act however you want: add any properties or methods you find useful.

In the following sections, you'll see an example of how your classes should look.

###Ip class:###

```php
<?php
// src/Entity/Ip.php

namespace App\Entity;

use Coosos\IpFilterBundle\Entity\Ip as BaseIp;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ip
 *
 * @ORM\Table(name="ips")
 */
class Ip extends BaseIp
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }
}
```

##Step 4: Configure your application##

### Set your classes and managers ###

```yml
# config/packages/config.yml
sl_ip_filter:
    ip_class: App\Entity\Ip
```

If you have your own managers, you can use them. They just need to implement `Coosos\IpFilterBundle\Model\IpManagerInterface`.

```yml
# app/config/config.yml
sl_ip_filter:
    ...
    ip_manager: my.custom.ip.entity_manager
```

###Security Strategy###

In order for this bundle to take effect, you need to change the default access decision strategy, which, by default, grants access if any voter grants access.

You also need to place your site behind a firewall rule.

```yml
# config/packages/security.yml
security:
    access_decision_manager:
        strategy: unanimous
…
firewalls: 
    my_site:
        pattern: ^/
        anonymous: ~

access_control:
    - { path: ^/, roles: IS_AUTHENTICATED_ANONYMOUSLY }
```

# How to #

## Small example ##

How to grant access for `192.168.1.10` on `dev` and `test` environments and deny all others?

```php
<?php

use Coosos\IpFilterBundle\Model\IpManagerInterface;

/** @var IpManagerInterface $ipManager */
$ipManager = $this->container->get('sl_ip_filter.ip_manager'); //Use this line, even if you use a custom IP manager

//Create your IP
$ip = $ipManager->createIp();
$ip->setStartIp('192.168.1.10') // Use only setStartIp() if it's a simple IP
   ->setEnvironment(['dev', 'test']) // You can also use 'prod'
   ->setAuthorized(false);

$ipManager->saveIp($ip);

// If you need to block or authorized an IP range, you must also specify an end ip with the setEndIp() method
$ip = $ipManager->createIp();
$ip->setStartIp('10.30.0.0')
   ->setEndIp('10.30.0.255')
   ->setEnvironment(['dev', 'test'])
   ->setAuthorized(true);

$ipManager->saveIp($ip);
```

## Network support ##

Networks can be supported using a Range object. You just need to get first and last IP addresses.
This bundle provides a range calculator, so you can easily extend your range entity using it.

```php
<?php

use Coosos\IpFilterBundle\Model\IpManagerInterface;

/** @var IpManagerInterface $ipManager */
$ipManager = $this->container->get('sl_ip_filter.ip_manager');

//All addresses (IPv4)
$range1 = $ipManager->hydrateModelWithIp('0.0.0.0/0');
$range1->setEnvironment(['dev', 'test'])
       ->setAuthorized(false);

$ipManager->saveIp($range1);

//My local network (IPv4)
$range2 = $ipManager->hydrateModelWithIp('192.168.0.0/16');
$range2->setEnvironment(['dev', 'test'])
       ->setAuthorized(true);

$ipManager->saveIp($range2);

//Another local network (IPv6)
$range3 = $ipManager->hydrateModelWithIp('fe80::/64');
$range3->setEnvironment(['dev', 'test'])
       ->setAuthorized(true);

$ipManager->saveIp($range3);
```
