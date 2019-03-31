<?php
require_once('../stripe-php-6.31.2/init.php');
\Stripe\Stripe::setApiKey("sk_test_RKWok6PoZoVFX0nav9VerMm2");
\Stripe\ApplePayDomain::create([
				'domain_name'	=>	'a0ce30f8.ngrok.io'
]);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
	<head>
		<title>TODO supply a title</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<script src="index.js" type="text/javascript"></script>
		<link href="index.css" rel="stylesheet" type="text/css"/>

	</head>
	<body>


		<div class="jumbotron jumbotron-fluid">
			<div class="container">
    <h1>Stripe Test</h1> 
    <p>This is a stripe test form to see the apple pay and google pay</p>
				<script src="https://js.stripe.com/v3/"></script>
				<div id="payment-request-button" allow="payment">
					<!-- A Stripe Element will be inserted here. -->
				</div>
			</div>

		</div>
		<div class="col-12">
			<form action="/charge" method="post" id="payment-form">
				<div class="form-row">
					<label for="card-element" class="d-block">
						Credit or debit card
					</label>

					<div id="card-element" allow="payment">
						<!-- A Stripe Element will be inserted here. -->
					</div>

					<!-- Used to display form errors. -->
					<div id="card-errors" role="alert"></div>
				</div>

				<button class="btn btn-success">Submit Payment</button>
			</form>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>

