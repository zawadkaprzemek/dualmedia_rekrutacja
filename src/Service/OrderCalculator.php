<?php

namespace App\Service;

use App\Entity\Order;

class OrderCalculator
{
    private iterable $calculators;

    public function __construct(iterable $calculators)
    {
        $this->calculators = $calculators;
    }

    public function calculate(Order $order): array
    {
        $results = [];
        foreach ($this->calculators as $calculator) {
            $results = array_merge($results, $calculator->calculate($order));
        }
        return $results;
    }
}