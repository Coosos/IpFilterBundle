# Changelog

## Release-v4.1.0

* Add Compatibility with Symfony 5
* Add PHP 7.4 to travis config
* Add PHPCS and PHPMD
* IpVoter: Use `IpManagerInterface` instead of `IpRepository` and use `findIpAddress` method from `IpManagerInterface`
* Rename `Coosos\IpFilterBundle\Voter\BaseIpVoter` to `Coosos\IpFilterBundle\Voter\AbstarctIpVoter`
* Add return type to `getRequest`, `getEnvironment` and `getIpRepository` 
  from `Coosos\IpFilterBundle\Voter\AbstarctIpVoter` methods class
* Remove `Tests/app/AppKernel.php` file (`Tests/config/Kernel.php` class is used instead)
* Remove `.scrutinizer.yml` file
* Restore default `Tests/config/bootstrap.php` file
* Fix multiples deprecated code
  * `src/Service/IpManager.php` 
     * Change inject constructor class `Symfony\Bridge\Doctrine\RegistryInterface` 
       to `Doctrine\Persistence\AbstractManagerRegistry`
     * `Doctrine\Common\Persistence\ObjectManager` to `Doctrine\Persistence\ObjectManager`
     * `Doctrine\Common\Persistence\ObjectRepository` to `Doctrine\Persistence\ObjectRepository`

## Release-v4.0.0

* Fork project from [Spomky-Labs/IpFilterBundle](https://github.com/Spomky-Labs/IpFilterBundle)
* Rename ``SpomkyLabs`` to ``Coosos`` namespace
* Replace ``behat`` by ``symfony/phpunit-bridge``
* Upgrade project to ``Symfony ^4.0``
* Use single model for IP (If "ipEnd" is null, then it is a filter on a static ip)
* Move ``Model\IpManager`` to ``Service\IpManager`` 
  * Add ``hydrateModelWithIp`` method for simplify the create a model from an IP with a subnetwork
