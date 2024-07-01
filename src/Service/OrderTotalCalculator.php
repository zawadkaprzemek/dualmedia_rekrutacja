<?php

namespace App\Service;

use App\Entity\Order;

class OrderTotalCalculator implements CalculatorServiceInterface
{
    public function calculate(Order $order): array
    {
        $total = 0;
        foreach ($order->getItems() as $item) {
            $total += round($item->getProduct()->getPrice() * $item->getQuantity(),2);
        }
        return ['total' => $total];
    }
}