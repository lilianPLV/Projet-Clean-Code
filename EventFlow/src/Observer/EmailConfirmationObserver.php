<?php 
class EmailConfirmationObserver
{

    public function EmailConfirmed(BookingConfirmed $event): void
    {
        $emailconfiremed = new EmailService();
        $emailconfiremed->sendConfirmation($event->booking->customer->email, $event->booking->customer->id);

    }
}