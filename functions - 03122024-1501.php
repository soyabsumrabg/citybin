<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );

// shortcode for display price plan and custom create for citybin.co
function citybin_display_json_data_shortcode() {
    $curent_page_url =  get_the_permalink();
	$html = '<div class="container">';
		//step 1 start
		$html .= '<div id="step1" class="step1 step_form" data-id="1">';
			ob_start();
			include locate_template( 'price_plan_template/step1.php' );
			$html .= ob_get_clean();
		$html .= '</div>';
		//step 1 end

		//step 2 start
		$html .= '<div id="step2" class="step2 step_form" data-id="2" style="display:none;">';
			ob_start();
			include locate_template( 'price_plan_template/step2.php' );
			$html .= ob_get_clean();
		$html .= '</div>';
		//step 2 end

		//step 3 start
		$html .= '<div id="step3" class="step3 step_form" data-id="3" style="display:none;">';
			ob_start();
			include locate_template( 'price_plan_template/step3.php' );
			$html .= ob_get_clean();
		$html .= '</div>';
		//step 3 end

		//step 4 start
		$html .= '<div id="step4" class="step4 step_form" data-id="4" style="display:none;">';
			ob_start();
			include locate_template( 'price_plan_template/step4.php' );
			$html .= ob_get_clean();
		$html .= '</div>';
		//step 4 end

		//step 5 start
		$html .= '<div id="step5" class="step5 step_form" data-id="5" style="display:none;">';
			ob_start();
			include locate_template( 'price_plan_template/step5.php' );
			$html .= ob_get_clean();
		$html .= '</div>';
		//step 5 end
    $html .= '</div>'; // Close Bootstrap row and container

    // Add script for Read More / Read Less functionality
    $html .= '<style>
	/* Switch container */
	.switch {
		position: relative;
		display: inline-block;
		width: 50px;
		height: 24px;
		margin: 10px;
	}

	/* Hide the default checkbox */
	.switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	/* The slider */
	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		transition: 0.4s;
		border-radius: 24px;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 18px;
		width: 18px;
		left: 3px;
		bottom: 3px;
		background-color: white;
		transition: 0.4s;
		border-radius: 50%;
	}

	/* When the switch is checked */
	input:checked + .slider {
		background-color: #e74c3c;
	}

	input:checked + .slider:before {
		transform: translateX(26px);
	}

	/* Labels for the switch */
	.switch-labels {
		display: flex;
		justify-content: space-between;
		width: 150px;
		margin-top: 5px;
	}

	.switch-labels span {
		font-size: 14px;
		font-weight: bold;
		color: #999;
		cursor: pointer;
		user-select: none;
	}

	.switch-labels span.active {
		color: #e74c3c;
	}
	.error.error-message {
		color: red;
	}
	</style>'."<script>" . citybin_get_switch_js_script() . "</script>";

    return $html;

}
add_shortcode('display_json_data', 'citybin_display_json_data_shortcode');

function citybin_get_switch_js_script() {
    return <<<JS
	document.addEventListener('DOMContentLoaded', function() {
		const switchInput = document.getElementById('period-switch');
		const periodDataSections = document.querySelectorAll('.period-data');
		const label1 = document.getElementById('label-1');
		const label12 = document.getElementById('label-12');

		function updateDisplay() {
			const selectedPeriod = switchInput.checked ? '12' : '1';

			// Toggle labels
			label1.classList.toggle('active', !switchInput.checked);
			label12.classList.toggle('active', switchInput.checked);

			// Show/hide sections
			periodDataSections.forEach(section => {
				if (section.getAttribute('data-period') === selectedPeriod) {
					section.style.display = 'block';
				} else {
					section.style.display = 'none';
				}
			});
		}

		// Attach event listener to the switch
		switchInput.addEventListener('change', updateDisplay);

		// Initialize the display
		updateDisplay();
	});
	JS;
}

function citybin_enqueue_bootstrap_styles() {
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', [], '4.5.2');
	wp_enqueue_style('autoaddress-css', 'https://api.autoaddress.ie/2.0/control/css/autoaddress.min.css', [], '4.5.2');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js',array('jquery'), time(), true);
	wp_enqueue_script('jquery-autoaddress', 'https://api.autoaddress.ie/2.0/control/js/jquery.autoaddress.min.js',array('jquery'), time(), true);
	wp_enqueue_script('citybin-signup', get_stylesheet_directory_uri().'/assets/js/citybin-signup.js',array('jquery'), time(), true);
    // Localize the script with the admin-ajax URL
    wp_localize_script('citybin-signup', 'citybin_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('thank_you_nonce') // Generate the nonce
    ));

}
add_action('wp_enqueue_scripts', 'citybin_enqueue_bootstrap_styles');

function citybin_fetch_price_plans_with_highest_price_grouped() {
    // Define the API endpoint and headers
    $url = 'https://citybin.wis.ie/WIS/rest/api/pricePlans';
    $headers = [
        'Authorization' => 'Basic cG9pbnRibGFua191c2VyOmNcPlAsV3EzZjdaenY4Ww==',
        'Cookie' => 'PHPSESSID=emrv025tcs22m9tij0o0vp4dq1',
    ];

    // Perform the request
    $response = wp_remote_get($url, [
        'headers' => $headers,
        'timeout' => 10,
    ]);

    // Check for errors
    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    }

    // Decode the JSON response
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!isset($data['data']) || !is_array($data['data'])) {
        return 'Invalid response format.';
    }

    // Filter data: group by title and allowance_period, keeping highest price
    $grouped_data = [];

    foreach ($data['data'] as $record) {
        $title = trim($record['title'] ?? ''); // Default to empty if missing
        $allowance_period = $record['allowance_period'] ?? 0; // Default to 0 if missing
        $price = $record['value'] ?? 0; // Default to 0 if missing
		$web_status = $record['web_status'] ?? 0;
		$description = $record['description'] ?? '';
        if (($title === '' || $web_status==0 || $web_status==0 || $description=='') && $allowance_period!=12) {
            continue; // Skip invalid records
        }

        // Unique key: combine title and allowance_period
        $key = $title . '|' . $allowance_period;

        // Keep the record with the highest price for each unique key
        if (!isset($grouped_data[$key]) || $price > $grouped_data[$key]['value']) {
            $grouped_data[$key] = $record;
        }
    }

    // Reformat grouped data into an array grouped by allowance_period
    $output = [];
    foreach ($grouped_data as $record) {
        $allowance_period = $record['allowance_period'];
        if (!isset($output[$allowance_period])) {
            $output[$allowance_period] = [];
        }
        $output[$allowance_period][] = $record;
    }

    // Return the grouped data as JSON
    return json_encode($output, JSON_PRETTY_PRINT);
}

//store signup user details
function citybin_user_info_store(){
	//echo '<pre>',print_r($_POST),'</pre>';
	check_ajax_referer('thank_you_nonce', 'nonce');
	$firstName = sanitize_text_field($_POST['firstName'] ?? '');
	$surname = sanitize_text_field($_POST['surname'] ?? '');
	$mobileNumber = sanitize_text_field($_POST['mobileNumber'] ?? '');
	$email = sanitize_email($_POST['email'] ?? '');
	$promoCode = sanitize_text_field($_POST['promoCode'] ?? '');
	//$yourAddress = sanitize_text_field($_POST['yourAddress'] ?? '');
	$houseNumber = sanitize_text_field($_POST['houseNumber'] ?? '');
	$address1 = sanitize_text_field($_POST['address1'] ?? '');
	$address2 = sanitize_text_field($_POST['address2'] ?? '');
	$address3 = sanitize_text_field($_POST['address3'] ?? '');
	$address4 = sanitize_text_field($_POST['address4'] ?? '');
	$eircode = sanitize_text_field($_POST['eircode'] ?? '');
	$sendOccasionalNews = sanitize_text_field($_POST['sendOccasionalNews'] ?? '');
	$termCondition = sanitize_text_field($_POST['termCondition'] ?? '');
	$plan_id = sanitize_text_field($_POST['selected_plan_id'] ?? 0);
	$plan_title = sanitize_text_field($_POST['selected_plan_title'] ?? '');
	$plan_price = sanitize_text_field($_POST['selected_plan_price'] ?? '');
	$plan_period = sanitize_text_field($_POST['selected_plan_period'] ?? '');

	$iban = sanitize_text_field($_POST['iban'] ?? '');
	$bankName = sanitize_text_field($_POST['bankName'] ?? '');
	$swift = sanitize_text_field($_POST['swift'] ?? '');
	$accountHolder = sanitize_text_field($_POST['accountHolder'] ?? '');
    // Define the endpoint URL
    $url = 'https://citybin.wis.ie/WIS/rest/api/customer?plan_bins=1&geocode=1';

	$email = 'pointblankire@gmail.com';
	$firstName = 'DevTestFirstname';
	$surname = 'DevTestSurname';
	$name = implode( ' ', array($firstName,$surname));
    // Define the body of the request
    $body = array(
        //"ref_id" => "",
        "status" => 1,
        "type" => 1,
        "route_id" => null,
        "pay_plan" => $plan_id,
        "pay_months" => $plan_period,
        "payment_method" => 2,
        "sales_agent" => 0,
        "email" => $email,
        "email_validated_datetime" => "",
        "mobile" => $mobileNumber,
        "password" => "",
        //"lat" => 0,
        //"lng" => 0,
        //"title" => 0,
        "first_name" => $firstName,
        "surname" => $surname,
        "house_no" => $houseNumber,
        "address1" => $address1,
        "address2" => $address2,
        "address3" => $address3,
        "address4" => $address4,
        "collection_eircode" => $eircode,
        "bfirst_name" => $firstName,
        "bsurname" => $surname,
        "bhouse_no" => $houseNumber,
        "baddress1" => $address1,
        "baddress2" => $address2,
        "baddress3" => $address3,
        "baddress4" => $address4,
        "billing_eircode" => $eircode,
        //"service_charge_multiplier" => 0,
        //"service_charge_discount" => 0,
        //"next_charge_date" => "2024-11-26",
        //"last_invoice_date" => "2024-11-26",
        //"membership_from" => "",
        //"routed_on" => "",
        //"allow_push_notifications" => 0,
        //"post_invoice" => 0,
        //"email_invoice" => 0,
        "BIC" => "",
        "IBAN" => $iban,
        "bank_account_name" => $accountHolder,
        //"SEPA_SEQ_TYPE" => "",
        //"SEPA_mandate_id" => "",
        "bank_name" => $bankName,
        //"dd_frequency_id" => "",
        //"an_post_card" => "",
        //"payzone_card" => "",
        //"save_customer_card" => "",
        //"payment_customer" => "",
        //"payment_card_token" => "",
        //"card_preview_digits" => "4444 **** **** 4444",
        //"card_type_id" => "",
        //"credit_control_status_end_date" => "2025-03-04",
        //"credit_control_payment_amount" => 0.01,
        //"credit_control_payment_interval_days" => 3,
        //"credit_control_payment_start_date" => "2024-11-20",
        //"exp_date" => "2024-11-20",
        //"is_default" => 0,
        //"last_payment_date" => "2024-11-26",
        //"recurring_status" => "",
        //"preset_balance" => "",
        //"recurring_payment_days" => "",
        //"payment_start_date" => "2024-11-20",
        //"last_invoice_amount" => -50,
    );

    // Define headers
    $headers = array(
        'Content-Type' => 'application/json',
        'Authorization' => 'Basic cG9pbnRibGFua191c2VyOmNcPlAsV3EzZjdaenY4Ww==',
        'Cookie' => 'PHPSESSID=emrv025tcs22m9tij0o0vp4dq1',
    );

    // Make the POST request
    $response = wp_remote_post($url, array(
        'body' => wp_json_encode($body),
        'headers' => $headers,
        'timeout' => 10,
    ));

    // Check for errors
    if (is_wp_error($response)) {
        return $response->get_error_message();
    }else{
		$response_body =  wp_remote_retrieve_body($response);
		$response_data = json_decode($response_body, true);
		//echo '<pre>',print_r($response_data),'</pre>';
		if (isset($response_data['status']) && $response_data['status']==true) {
			$message = '<div class="billing_user_details">
				<h4>The service is purchased by:</h4>
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="billing_user_name">'.esc_html($name).'</div>
						<div class="billing_user_email">
							<strong>Email:</strong><span><a href="mailto:'.esc_html($email).'">'.esc_html($email).'</a></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="billing_user_mobile">
							<strong>Mobile:</strong><span>'.esc_html($mobileNumber).'</span>
						</div>
						<div class="billing_user_phone">
							<strong>Home Phone:</strong><span></span>
						</div>
					</div>
				</div>
			</div>
			<div class="billing_address_details">
				<h4>Bin collection will be take place at:</h4>
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="billing_address">'.esc_html($address1).'</div>
						<div class="billing_city">'.esc_html($address2).'</div>
						<div class="billing_town">'.esc_html($address3).'</div>
					</div>
					<div class="col-md-6">
						<div class="billing_country">
							<strong>Country:</strong><span>'.esc_html($address4).'</span>
						</div>
						<div class="billing_postcode">
							<strong>postal Code:</strong><span>'.esc_html($eircode).'</span>
						</div>
					</div>
				</div>
			</div>
			<div class="billing_user_email_sec">
				<h4>Bills will be sent via email to:</h4>
				<div class="user_email"><a href="mailto:'.esc_html($email).'">'.esc_html($email).'</a></div>
			</div>';
			wp_send_json_success(['message' => $message]);
		}else{
			//return $response_data['errors'];  // Return the error message
			if(isset($response_data['errors']) && $response_data['errors']!=''){
				return wp_send_json_error(['error' => $response_data['errors'][0]]);
			}elseif(isset($response_data['message']) && $response_data['messages']!=''){
				return wp_send_json_error(['error' => $response_data['message']]);
			}
			return wp_send_json_error(['error' => $response_data['message']]);
		}
	}
}
add_action( 'wp_ajax_user_info_store', 'citybin_user_info_store' );
add_action( 'wp_ajax_nopriv_user_info_store', 'citybin_user_info_store' );

function get_globalpay_access_token($permissions) {
    // API endpoint
    $url = 'https://apis.sandbox.globalpay.com/ucp/accesstoken';

    // Request headers
    $headers = array(
        'Content-Type'  => 'application/json',
        'X-GP-Version'  => '2021-03-22',
    );
	$timestamp = gmdate('Y-m-d\TH:i:s\Z');
	$secret = citybin_get_secret_key($timestamp);
    // Request body
    $body = array(
        'app_id'      => 'TPOuffuPbk17leRGvFsytrZK9NC0AndO',
        'nonce'       => $timestamp, // Generate a dynamic nonce using the current time
        'secret'      => $secret,
        'grant_type'  => 'client_credentials',
		//'permissions' => [ 'PMT_POST_Create_Single']
    );
	if(isset($permissions) && !empty($permissions)){
		$body['permissions'] = $permissions;
	}
    // Make the request
    $response = wp_remote_post($url, array(
        'headers' => $headers,
        'body'    => json_encode($body),
        'timeout' => 45,
    ));

    // Handle the response
    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    }

    $response_body = wp_remote_retrieve_body($response);
    $response_code = wp_remote_retrieve_response_code($response);

    return array(
        'code' => $response_code,
        'body' => json_decode($response_body, true),
    );
}

// Usage example
//$result = get_globalpay_access_token();


function citybin_get_secret_key($timestamp){
	$api_key = 'rX0UOzwpGQRzRbQn';

	// Concatenate the inputs
	$input = $timestamp . $api_key;

	// Generate the SHA-512 hash
	$secret = hash('sha512', $input);

	return $secret;
}