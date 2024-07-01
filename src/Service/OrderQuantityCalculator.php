<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\OrderItem;

class OrderQuantityCalculator implements CalculatorServiceInterface
{
    public function calculate(Order $order): array
    {
        $quantity = 0;
        /** @var OrderItem $item */
        foreach ($order->getItems() as $item) {
            $quantity += $item->getQuantity();
        }
        return ['quantity' => $quantity];
    }
}