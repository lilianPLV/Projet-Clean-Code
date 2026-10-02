<?php

declare(strict_types=1);

interface PayGateway
{
    public function pay(float $amount): string;
}