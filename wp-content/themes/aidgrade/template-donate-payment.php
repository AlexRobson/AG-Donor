<?php
/**
 * Template Name: Donate Payment
 *
 * @package WordPress
 * @subpackage Aid Grade
 */

get_header(); ?>

<div id="content">
	<div class="content_in">
		<?php if (isset($_)):
			if (isset($_POST['x_response_code'])): // From Authorize.Net ?>
		<div class="donate-message">
			The Transactions result is <?php echo $_POST['x_response_code']; ?>
		</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="donate">
			<?php
				if (function_exists('donations_init')) {
					$authnet_obj = donations_init();

					if (isset($_GET['tx'])) { // to show the CC form

						$authnet_obj->print_cc_form($_GET['tx'], $_GET['pf']);

					} else if (isset($_GET['response_code'])) { // Transaction Result

						if ($_GET['response_code'] == 1) {
							//echo "Thank you for your Donation! Transaction id: " . htmlentities($_GET['transaction_id']);
                            echo "Thank you for your donation! You should be getting an email confirmation shortly.";
						} else {
							echo "Sorry, an error occurred: " . htmlentities($_GET['response_reason_text']);
						}

					}
				}
			?>
		</div>
  </div>
</div>

<?php get_footer(); ?>
