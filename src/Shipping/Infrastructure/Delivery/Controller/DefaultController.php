<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 01/04/2019
 * Time: 17:55
 */

namespace F4u\Shipping\Infrastructure\Delivery\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        return new Response('This is shipping API!');
    }
}