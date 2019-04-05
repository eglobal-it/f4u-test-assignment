<?php
/**
 * Created by PhpStorm.
 * User: alexander.demchenko
 * Date: 04/04/2019
 * Time: 22:08
 */
namespace F4u\Shipping\Infrastructure\Delivery\Controller\Api;


use F4u\Shipping\Application\Service\ShippingAddress\AddShippingAddress;
use F4u\Shipping\Application\Service\ShippingAddress\DataTransformer\JsonShippingAddressDataTransformer;
use F4u\Shipping\Application\Service\ShippingAddress\EditShippingAddress;
use F4u\Shipping\Application\Service\ShippingAddress\ListShippingAddress;
use F4u\Shipping\Application\Service\ShippingAddress\RemoveShippingAddress;
use F4u\Shipping\Application\Service\ShippingAddress\ShippingAddressInfo;
use F4u\Shipping\Application\Service\ShippingAddress\ShippingAddressParameters;
use F4u\Shipping\Domain\Model\Client\ClientId;
use F4u\Shipping\Domain\Model\ShippingAddress\Address;
use F4u\Shipping\Domain\Model\ShippingAddress\ShippingAddressId;
use F4u\Shipping\Infrastructure\Persistence\Doctrine\Repository\DoctrineClientRepository;
use F4u\Shipping\Infrastructure\Persistence\Doctrine\Repository\DoctrineShippingAddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippingAddressController extends AbstractController
{
    public function info($shippingAddressId)
    {
        $em = $this->getDoctrine()->getManager();
        $dataTransaformer = new JsonShippingAddressDataTransformer();
        $service = new ShippingAddressInfo(
            new DoctrineShippingAddressRepository($em),
            $dataTransaformer
        );
        try {
            $service->run(new ShippingAddressId($shippingAddressId));
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
        return new Response($dataTransaformer->read());
    }

    public function list($clientId)
    {
        $em = $this->getDoctrine()->getManager();
        $dataTransaformer = new JsonShippingAddressDataTransformer();
        $service = new ListShippingAddress(
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

    public function remove($shippingAddressId)
    {
        $em = $this->getDoctrine()->getManager();
        $service = new RemoveShippingAddress(
            new DoctrineShippingAddressRepository($em)
        );
        try {
            $service->run(new ShippingAddressId($shippingAddressId));
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
        return $this->json([]);
    }

    public function add(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $dataTransformer = new JsonShippingAddressDataTransformer();
        $service = new AddShippingAddress(
            new DoctrineClientRepository($em),
            new DoctrineShippingAddressRepository($em),
            $dataTransformer
        );
        try {
            $service->run(
                new ClientId($content['client_uuid'] ?? ''),
                new ShippingAddressParameters(
                    new Address(
                        $content['zipcode'] ?? '',
                        $content['street'] ?? '',
                        $content['city'] ?? '',
                        $content['country'] ?? ''
                    ),
                    $content['is_default'] ?? ''
                )
            );
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
        return new Response($dataTransformer->read());
    }

    public function edit(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $service = new EditShippingAddress(
            new DoctrineShippingAddressRepository($em)
        );
        try {
            $service->run(
                new ShippingAddressId($content['shipping_address_uuid'] ?? ''),
                new ShippingAddressParameters(
                    new Address(
                        $content['zipcode'] ?? '',
                        $content['street'] ?? '',
                        $content['city'] ?? '',
                        $content['country'] ?? ''
                    ),
                    $content['is_default'] ?? ''
                )
            );
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
        return new Response();
    }
}