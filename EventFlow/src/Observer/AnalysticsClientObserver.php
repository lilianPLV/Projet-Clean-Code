<?php

class AnalyticsClientObserver {


    public function analysticClient(BookingConfirmed $event): void
    {
        $AnalyticsClients = new AnalyticsClient();
        $AnalyticsClients->track($event->booking->event, $event->booking->data);
    }
}