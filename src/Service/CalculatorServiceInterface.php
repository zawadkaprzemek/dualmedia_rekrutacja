<?php

namespace App\Service;

use App\Entity\Order;

interface CalculatorServiceInterface
{
    public function calculate(Order $order): array;
}