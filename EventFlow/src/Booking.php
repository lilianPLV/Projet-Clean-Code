<?php

declare(strict_types=1);

final class Booking
{
    /** @var BookingItem[] */
    public array $items = [];
    public string $status = 'pending';

    public function __construct(
        public int $id,
        public Customer $customer,
        public string $passType = 'day',
        public string $event = 'Paris-Orléans',
        public array $data = [],
        public int $LoyaltyPoints = 10
    ) {
    }

    public function addItem(BookingItem $item): void
    {
        $this->items[] = $item;
    }
}
