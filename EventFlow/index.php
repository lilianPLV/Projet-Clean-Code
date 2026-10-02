<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$customer = new Customer(
    id: 42,
    email: 'lea@example.com',
    phone: '0612345678',
    type: 'vip'
);

$dayTicket = new Ticket(
    code: 'DAY-1',
    label: 'Pass Jour 1',
    price: 79.90
);

$booking = new Booking(
    id: 1001,
    customer: $customer,
    passType: 'day'
);

$gateway = new StripeAdapter(new StripeClient());

$booking->addItem(new BookingItem($dayTicket, 2));

$gateway = new StripeAdapter(new StripeClient());
//$gateway = new PayFastAdapter(new PayFastSdk());

$service = new BookingService();
$total = $service->confirm($booking, $gateway);

$analyticsClientObserver = new AnalyticsClientObserver();
$smsClientObserver = new SmsClientObserver();
$loyaltyPointObserver = new LoyaltyPointObserver();
$emailConfirmationObserver = new EmailConfirmationObserver();

$event = new BookingConfirmed($booking);

$analyticsClientObserver->analysticClient($event);
$smsClientObserver->Sms($event);
$loyaltyPointObserver->LoyaltyPoint($event);
$emailConfirmationObserver->EmailConfirmed($event);

$timerpaymentstart = microtime(true);
$timerpaymentend = microtime(true);

echo 'TOTAL FINAL: ' . number_format($total, 2, '.', '') . PHP_EOL;;
