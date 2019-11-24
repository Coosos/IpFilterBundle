<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'console.command.cache_pool_list' shared service.

$this->privates['console.command.cache_pool_list'] = $instance = new \Symfony\Bundle\FrameworkBundle\Command\CachePoolListCommand([0 => 'cache.security_expression_language', 1 => 'cache.app', 2 => 'cache.system', 3 => 'cache.validator', 4 => 'cache.serializer', 5 => 'cache.annotations', 6 => 'cache.property_info', 7 => 'cache.messenger.restart_workers_signal']);

$instance->setName('cache:pool:list');

return $instance;
