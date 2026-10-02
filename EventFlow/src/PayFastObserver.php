<?php

declare(strict_types=1);

class PayFastObserver implements PayGateway
{
    public function __construct(private readonly PayFastSdk $payfast) {}
    public function pay(float $amount): string 
    {
        $paylord = [
            'reference' => 'booking_' . bin2hex(random_bytes(8)),
            'amount_cents' => (int) round($amount * 100)
        ];
        $return = $this->payfast->executePayment($paylord);

        if (!$return['success']) throw new RuntimeException("The payment didn't go through");


        return 'payfast_' . number_format($amount, 2, '.', '');
    }
}