$(document).ready(function () {



	var stripe = Stripe('pk_test_gaoEzLVIxdnsWfWeSbj2Jikq');

	var paymentRequest = stripe.paymentRequest({
		country: 'US',
		currency: 'usd',
		total: {
			label: 'Demo total',
			amount: 1000,
		},

		requestShipping: true,
		// `shippingOptions` is optional at this point:
		shippingOptions: [
			// The first shipping option in this list appears as the default
			// option in the browser payment interface.
			{
				id: 'free-shipping',
				label: 'Free shipping',
				detail: 'Arrives in 5 to 7 days',
				amount: 0,
			},
		],
	});



	var elements = stripe.elements();

	var prButton = elements.create('paymentRequestButton', {
		paymentRequest: paymentRequest,
	});

// Check the availability of the Payment Request API first.
	paymentRequest.canMakePayment().then(function (result) {
		if (result) {
			prButton.mount('#payment-request-button');
		} else {
			document.getElementById('payment-request-button').style.display = 'none';
		}
	});

// Check the availability of the Payment Request API first.
	paymentRequest.canMakePayment().then(function (result) {
		if (result) {
			prButton.mount('#payment-request-button');
		} else {
			document.getElementById('payment-request-button').style.display = 'none';
		}
	});


	paymentRequest.on('shippingaddresschange', function (ev) {
		if (ev.shippingAddress.country !== 'US') {
			ev.updateWith({status: 'invalid_shipping_address'});
		} else {
			// Perform server-side request to fetch shipping options
			fetch('/calculateShipping', {
				data: JSON.stringify({
					shippingAddress: ev.shippingAddress
				})
			}).then(function (response) {
				return response.json();
			}).then(function (result) {
				ev.updateWith({
					status: 'success',
					shippingOptions: result.supportedShippingOptions,
				});
			});
		}
	});

});