<?php

class LoyaltyPointObserver
{

    public function LoyaltyPoint(BookingConfirmed $event): void
    {
        $loyaltyPointSent = new LoyaltyService();
        $loyaltyPointSent->addPoints($event->booking->customer->id, $event->booking->LoyaltyPoints);

    }
}