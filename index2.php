<!DOCTYPE html>
<html lang="en">

	<head>
		<?php
		require_once('structure_components/header.php');
		?>

	</head>

	<body id="page-top">
		<?php
		require_once('stripe-php-6.31.2/init.php');
		?>
  <!-- Page Wrapper -->
  <div id="wrapper">

			<!-- Sidebar -->
			<?php
			require_once('structure_components/sidenav.php');
			?>
			<!-- End of Sidebar -->

			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">

				<!-- Main Content -->
				<div id="content">

					<!-- Topbar -->
					<?php
					require_once('structure_components/topbar.php');
					?>
					<!-- End of Topbar -->

					<!-- Begin Page Content -->
					<div class="container-fluid">

						<!-- Page Heading -->
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Stripe Test</h1>
						</div>

						<!-- Content Row -->

						<div class="row">

							<!-- Area Chart -->
							<div class="col-xl-12 col-lg-12">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">Option 1</h6>
									</div>
									<style>
										.StripeElement {
											box-sizing: border-box;

											height: 40px;

											padding: 10px 12px;

											border: 1px solid transparent;
											border-radius: 4px;
											background-color: white;

											box-shadow: 0 1px 3px 0 #e6ebf1;
											-webkit-transition: box-shadow 150ms ease;
											transition: box-shadow 150ms ease;
										}

										.StripeElement--focus {
											box-shadow: 0 1px 3px 0 #cfd7df;
										}

										.StripeElement--invalid {
											border-color: #fa755a;
										}

										.StripeElement--webkit-autofill {
											background-color: #fefde5 !important;
										}
										body{
											background: red!important
										}
									</style>
									<!-- Card Body -->
									<div class="card-body">

										<form action="/charge" method="post" id="payment-form">
											<div class="form-row">
												<label for="card-element">
													Credit or debit card
												</label>
												<div id="card-element" class="StripeElement">
													<!-- A Stripe Element will be inserted here. -->
												</div>

												<!-- Used to display form errors. -->
												<div id="card-errors" role="alert"></div>
											</div>

											<button class="btn btn-success">Submit Payment</button>
										</form>

									</div>
								</div>
							</div>



						</div>
					</div>
					<!-- /.container-fluid -->

				</div>
				<!-- End of Main Content -->

				<!-- Footer -->
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; Your Website 2019</span>
						</div>
					</div>
				</footer>
				<!-- End of Footer -->

			</div>
			<!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="login.html">Logout</a>
					</div>
				</div>
			</div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

		<script>
			// Create a Stripe client.
			var stripe = Stripe('pk_test_gaoEzLVIxdnsWfWeSbj2Jikq');
			// Create an instance of Elements.
			var elements = stripe.elements();
			// Custom styling can be passed to options when creating an Element.
			// (Note that this demo uses a wider set of styles than the guide below.)
			var style = {
				base: {
					color: '#32325d',
					fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
					fontSmoothing: 'antialiased',
					fontSize: '16px',
					'::placeholder': {
						color: '#aab7c4'
					}
				},
				invalid: {
					color: '#fa755a',
					iconColor: '#fa755a'
				}
			};

			// Create an instance of the card Element.
			var card = elements.create('card', {style: style});

			// Add an instance of the card Element into the `card-element` <div>.
			card.mount('#card-element');

			// Handle real-time validation errors from the card Element.
			card.addEventListener('change', function (event) {
				var displayError = document.getElementById('card-errors');
				if (event.error) {
					displayError.textContent = event.error.message;
				} else {
					displayError.textContent = '';
				}
			});

			// Handle form submission.
			var form = document.getElementById('payment-form');
			form.addEventListener('submit', function (event) {
				event.preventDefault();
				stripe.createToken(card).then(function (result) {
					if (result.error) {
						// Inform the user if there was an error.
						var errorElement = document.getElementById('card-errors');
						errorElement.textContent = result.error.message;
					} else {
						// Send the token to your server.
						stripeTokenHandler(result.token);
					}
				});
			});

			// Submit the form with the token ID.
			function stripeTokenHandler(token) {
				// Insert the token ID into the form so it gets submitted to the server
				var form = document.getElementById('payment-form');
				var hiddenInput = document.createElement('input');
				hiddenInput.setAttribute('type', 'hidden');
				hiddenInput.setAttribute('name', 'stripeToken');
				hiddenInput.setAttribute('value', token.id);
				form.appendChild(hiddenInput);
				// Submit the form
				form.submit();
			}
		</script>
	</body>

</html>
