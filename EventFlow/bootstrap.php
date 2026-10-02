<?php

declare(strict_types=1);

require_once __DIR__ . '/src/Customer.php';
require_once __DIR__ . '/src/Ticket.php';
require_once __DIR__ . '/src/BookingItem.php';
require_once __DIR__ . '/src/Booking.php';
require_once __DIR__ . '/src/StripeClient.php';
require_once __DIR__ . '/src/PayFastSdk.php';
require_once __DIR__ . '/src/EmailService.php';
require_once __DIR__ . '/src/SmsClient.php';
require_once __DIR__ . '/src/LoyaltyService.php';
require_once __DIR__ . '/src/AnalyticsClient.php';
require_once __DIR__ . '/src/BookingService.php';
require_once __DIR__ . '/src/CalculReduction.php';
require_once __DIR__ . '/src/Observer/BookingConfirmed.php';
require_once __DIR__ . '/src/Observer/AnalysticsClientObserver.php';
require_once __DIR__ . '/src/Observer/EmailConfirmationObserver.php';
require_once __DIR__ . '/src/Observer/LoyaltyPointObserver.php';
require_once __DIR__ . '/src/Observer/SmsClientObserver.php';
require_once __DIR__ . '/src/PayGateway.php';
require_once __DIR__ . '/src/StripeAdapter.php';
require_once __DIR__ . '/src/PayFastAdapter.php';