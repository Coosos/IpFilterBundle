<?php

namespace Coosos\AppIpFilterBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 *
 * @package Coosos\AppIpFilterBundle\Controller
 * @author  Remy Lescallier <lescallier1@gmail.com>
 */
class DefaultController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function index()
    {
        return new Response('Hello world');
    }
}
