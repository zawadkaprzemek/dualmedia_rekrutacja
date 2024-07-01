<?php

namespace App\Service;

use App\Entity\Order;

class NettoCalculator implements CalculatorServiceInterface
{
    private const VAT_RATE = 0.23;

    public function calculate(Order $order): array
    {
        $total = 0;
        foreach ($order->getItems() as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
        }
        $vat = round($total / (1 + self::VAT_RATE), 2);
        return ['netto' => $vat];
    }
}