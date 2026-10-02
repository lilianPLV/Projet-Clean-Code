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

$gateway = new StripeAdapter(new StripeClient());
//$gateway = new PayFastAdapter(new PayFastSdk());

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

// Correct PhoneNumber
$phonenumber = createBooking('standard', 'day', 50.0, 2, '0612345678');
$tests->same(10,strlen($phonenumber->customer->phone),'phone number contains 10 digits');




// VIP : total < 100 €
$vip100 = createBooking('vip', 'day', 80.0, 1);

$vip100Total = $service->confirm($vip100, $gateway);

$tests->near(
    76.0,
    $vip100Total,
    'VIP gets 5 percent discount below 100 euros'
);

// VIP :   100 € < total <299 €
$vip300 = createBooking('vip', 'day', 200.0, 1);

$vip300Total = $service->confirm($vip300, $gateway);

$tests->near(
    180.0,
    $vip300Total,
    'VIP gets 10 percent discount between 100 and 299 euros'
);

// VIP : total > 300 €
$vipSuperior300 = createBooking('vip', 'day', 400.0, 1);

$vipSuperior300Total = $service->confirm($vipSuperior300, $gateway);

$tests->near(
    340.0,
    $vipSuperior300Total,
    'VIP gets 15 percent discount from 300 euros'
);

$tests->same(true,$bookingTotal >= 0,'final ticket price is not negative after discount');

$cheapThreeDays = createBooking('standard', '3days', 20.0, 1);

$cheapThreeDaysTotal = $service->confirm($cheapThreeDays, $gateway);

$tests->same(
    0.0,
    $cheapThreeDaysTotal,
    'final ticket price cannot be negative'
);

ob_end_clean();
$tests->summary();
