<?php

require_once('stripe-php-6.31.2/init.php');
\Stripe\Stripe::setApiKey("sk_test_RKWok6PoZoVFX0nav9VerMm2");
$token	=	$_POST['stripeToken'];
$charge	=	\Stripe\Charge::create([
												'amount'	=>	1900,
												'currency'	=>	'eur',
												'description'	=>	'Test charge',
												'source'	=>	$token,
								]);

header('Location: http://localhost/Test-Stripe/index.php');