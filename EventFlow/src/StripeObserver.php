<?php

declare(strict_types=1);

class StripeObserver implements PayGateway
{
    public function __construct(private readonly StripeClient $stripe) {}
    public function pay(float $amount): string
    {
        return $this->stripe->charge($amount); 
    }
}