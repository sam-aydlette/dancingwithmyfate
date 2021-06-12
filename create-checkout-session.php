<?php

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('INSERT PRIVATE KEY HERE');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://dancingwithmyfate.com';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'shipping_address_collection' => [
      'allowed_countries' => ['US'],
    ],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'unit_amount' => 1499,
      'product_data' => [
        'name' => 'Dancing With My Fate',
        'images' => ["closeup_cover.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

echo json_encode(['id' => $checkout_session->id]);
