<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/TestRunner.php';

$tests = new TestRunner();

function createBooking(
    string $customerType = 'standard',
    string $passType = 'day',
    float $price = 50.0,
    int $quantity = 1,
    ?string $phone = '0600000000'
): Booking {
    $customer = new Customer(1, 'test@example.com', $phone, $customerType);
    $ticket = new Ticket('TEST', 'Ticket test', $price);
    $booking = new Booking(1, $customer, $passType);
    $booking->addItem(new BookingItem($ticket, $quantity));
    return $booking;
}

$gateway = new StripeObserver(new StripeClient());

ob_start();
$service = new BookingService();

$standard = createBooking('standard', 'day', 50.0, 2);
$standardTotal = $service->confirm($standard, $gateway);
$tests->near(100.0, $standardTotal, 'standard customer keeps initial total');
$tests->same('confirmed', $standard->status, 'booking becomes confirmed');

$vip = createBooking('vip', 'day', 50.0, 2);
$vipTotal = $service->confirm($vip, $gateway);
$tests->near(90.0, $vipTotal, 'legacy VIP rule gives 10 percent discount');

$threeDays = createBooking('standard', '3days', 60.0, 2);
$threeDaysTotal = $service->confirm($threeDays, $gateway);
$tests->near(100.0, $threeDaysTotal, 'legacy three day pass discount is 20 euros');
<<<<<<< Updated upstream


$phonenumber = createBooking('standard', 'day', 50.0, 2, '0612345678');
$tests->same(10,strlen($phonenumber->customer->phone),'phone number contains 10 digits');


$TicketPrice = createBooking('vip', 'day', 50.0, 2);

$bookingTotal = $service->confirm($TicketPrice, $gateway);

$tests->same(true,$bookingTotal >= 0,'final ticket price is not negative after discount');

=======
>>>>>>> Stashed changes

ob_end_clean();
$tests->summary();
