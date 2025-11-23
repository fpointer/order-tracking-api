<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrackOrderController extends AbstractController
{
    public function __invoke(string $trackingNumber, OrderRepository $repo): JsonResponse
    {
        $order = $repo->findOneBy(['trackingNumber' => $trackingNumber]);

        if (!$order) {
            return new JsonResponse(['message' => 'Tracking number not found'], 404);
        }

        return new JsonResponse([
            'trackingNumber' => $order->getTrackingNumber(),
            'status' => $order->getStatus(),
            'origin' => $order->getOrigin(),
            'destination' => $order->getDestination(),
            'items' => $order->getItems(),
            'expectedDeliveryDate' => $order->getExpectedDeliveryDate(),
            'createdAt' => $order->getCreatedAt(),
            'updatedAt' => $order->getUpdatedAt()
        ]);
    }
}
