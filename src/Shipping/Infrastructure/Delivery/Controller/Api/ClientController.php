<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 04/04/2019
 * Time: 22:08
 */
namespace F4u\Shipping\Infrastructure\Delivery\Controller\Api;


use F4u\Shipping\Application\Service\Client\ClientInfo;
use F4u\Shipping\Application\Service\Client\DataTransformer\JsonClientDataTransformer;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Infrastructure\Persistence\Doctrine\Repository\DoctrineClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends AbstractController
{
    public function info($clientId)
    {
        $em = $this->getDoctrine()->getManager();
        $dataTransaformer = new JsonClientDataTransformer();
        $service = new ClientInfo(
            new DoctrineClientRepository($em),
            $dataTransaformer
        );
        try {
            $service->run(new ClientId($clientId));
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
        return new Response($dataTransaformer->read());
    }
}