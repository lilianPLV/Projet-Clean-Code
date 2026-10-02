<?php
class SmsClientObserver {

    public function Sms(BookingConfirmed $event): void
    {
        $phone = $event->booking->customer->phone;

        if ($phone === null) {
            return;
        }
        
        $SmsSent = new \SmsClient();
        $SmsSent->send($phone,'Votre réservation est confirmée.');
    }
}