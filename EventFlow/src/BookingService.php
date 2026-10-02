<?php

declare(strict_types=1);


final class BookingService
{
    public function confirm(Booking $booking, PayGateway $paymentMethod): float
    {
        if ($booking->isEmpty()) {
            throw new RuntimeException('Empty booking');
        }

        if (!$booking->customer->hasValidEmail()) {
            throw new RuntimeException('Invalid email');
        }

        $total = 0.0;

        foreach ($booking->items as $item) {
            if ($item->quantity <= 0) {
                throw new RuntimeException('Invalid quantity');
            }

            $total += $item->ticket->price * $item->quantity;
        }

        $reduction = [  'TotalLowerThan100'     => 0.95,
                        'TotalLowerThan300'     => 0.9,
                        'TotalSuperiorThan300' => 0.85,
                        'Reduction20' => 20];

        $stepReduction = [ 'FirstStepReduction' => 100,
                            'SecondStepReduction' => 300];

        if ($booking->customer->type === 'vip') {
            $valueReductionVIP = new CalculReductionVIP($reduction, $stepReduction);
            $total = $valueReductionVIP->calcul($total);

        }

        if ($booking->passType === '3days') {
            $valueReductionPassType = new CalculReductionPassType($reduction);
            $total = $valueReductionPassType->calcul($total);
        }

        echo 'The total amount requested is: ' . $total . PHP_EOL;  

        $start = hrtime(true);
        $transactionId = $paymentMethod->pay($total);
        $end = (hrtime(true) - $start) / 1_000_000;

        echo "PAYMENT:{$transactionId} " . PHP_EOL;
        echo sprintf ("Payment duration: %.5f ms", $end) . PHP_EOL;


        $booking->status = 'confirmed';

        echo "SQL INSERT booking={$booking->id} total={$total} status={$booking->status}" . PHP_EOL;



        $verificationTotalPositive = new CalculTotalReduction($reduction);
        $total = $verificationTotalPositive->calcul($total);

        return $total;
    }
}
