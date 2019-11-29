# Changelog

## Release-v4.0.0

* Fork project from [Spomky-Labs/IpFilterBundle](https://github.com/Spomky-Labs/IpFilterBundle)
* Rename ``SpomkyLabs`` to ``Coosos`` namespace
* Replace ``behat`` by ``symfony/phpunit-bridge``
* Upgrade project to ``Symfony ^4.0``
* Use single model for IP (If "ipEnd" is null, then it is a filter on a static ip)
* Move ``Model\IpManager`` to ``Service\IpManager`` 
  * Add ``hydrateModelWithIp`` method for simplify the create a model from an IP with a subnetwork
