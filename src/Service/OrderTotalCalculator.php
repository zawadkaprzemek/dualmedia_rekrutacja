<?php

namespace App\Service;

use App\Entity\Order;

class OrderTotalCalculator implements CalculatorServiceInterface
{
    public function calculate(Order $order): array
    {
        $total = 0;
        foreach ($order->getItems() as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }
        return ['total' => $total];
    }
}