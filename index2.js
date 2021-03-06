
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
elements.create('paymentRequestButton', {
	paymentRequest: paymentRequest,
	style: {
		paymentRequestButton: {
			type: 'default' | 'donate' | 'buy', // default: 'default'
			theme: 'dark' | 'light' | 'light-outline', // default: 'dark'
			height: '64px', // default: '40px', the width is always '100%'
		},
	},
});

// Check the availability of the Payment Request API first.
paymentRequest.canMakePayment().then(function (result) {
	if (result) {
		prButton.mount('#payment-request-button');
	} else {
		document.getElementById('payment-request-button').style.display = 'none';
	}
});

paymentRequest.on('token', function (ev) {
	// Send the token to your server to charge it!
	fetch('/charges', {
		method: 'POST',
		body: JSON.stringify({token: ev.token.id}),
		headers: {'content-type': 'application/json'},
	})
									.then(function (response) {
										if (response.ok) {
											// Report to the browser that the payment was successful, prompting
											// it to close the browser payment interface.
											ev.complete('success');
										} else {
											// Report to the browser that the payment failed, prompting it to
											// re-show the payment interface, or show an error message and close
											// the payment interface.
											ev.complete('fail');
										}
									});
});