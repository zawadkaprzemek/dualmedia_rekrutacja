<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Service\OrderCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/order', name: 'app_order_')]
class OrderController extends AbstractController
{
    public function __construct(
        protected readonly EntityManagerInterface $em,
        protected readonly OrderCalculator        $calculator
    )
    {
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $order = new Order();

        foreach ($data['items'] as $item) {
            $product = $this->em->getRepository(Product::class)->find($item['product_id']);
            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $orderItem->setQuantity($item['quantity']);
            $order->addItem($orderItem);
        }

        $this->em->persist($order);
        $this->em->flush();

        $orderData = $this->calculator->calculate($order);

        return $this->json(['order' => $order, 'calculation' => $orderData], Response::HTTP_OK, [], ['groups' => 'order:read']);
    }

    #[Route('/{id}', name: 'get_order', methods: ['GET'])]
    public function getOrder(int $id, EntityManagerInterface $em): JsonResponse
    {
        $order = $em->getRepository(Order::class)->find($id);
        if (!$order) {
            throw $this->createNotFoundException('Order not found');
        }
        $orderData = $this->calculator->calculate($order);
        return $this->json(['order' => $order, 'calculation' => $orderData], 200, [], ['groups' => ['order:read']]);
    }
}
