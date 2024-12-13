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


function display_json_data_shortcode() {
    // Set the default JSON file path
    //echo $file_path = get_template_directory(  ).'/priceplace.json';

    // Check if the file exists
    /*if (!file_exists($file_path)) {
        return '<p>JSON file not found.</p>';
    }*/

    // Get the JSON file content
    //$json_content = file_get_contents($file_path);
	$json_content = fetch_price_plans_with_highest_price_grouped();
    $data = json_decode($json_content, true);
	//echo '<pre>',print_r($data),'</pre>';
	///exit;
    if (json_last_error() !== JSON_ERROR_NONE) {
        return '<p>Invalid JSON format.</p>';
    }

    // Build the Bootstrap grid layout with Read More toggle
    $html = '<div class="container">
		//step 1 start
		<div id="step1" class="step1 step_form" data-id="1">
			<h3 class="text-center">Price Plan</h3>
			<input type="hidden" name="selected_plan_id" id="selected_plan_id" value="">';
			$html .= "<label class='switch'>
			<input type='checkbox' id='period-switch' value='1'>
			<span class='slider'></span>
			</label>";
			$html .= "<div class='switch-labels'>
			<span id='label-1' class='active'>Billed Monthly</span>
			<span id='label-12'>Billed Annually</span>
			</div>";
		$output = '';
		foreach ($data as $index => $priceplan) {
			$style = 'display: none;';
			$active_cls = '';
			if($index==1){
				$style = 'display: block;';
				$active_cls = 'active';
			}
			//$html .= "<button class='toggle-btn ".$active_cls."' data-period='$index'>Period $index</button>";

			// Create a hidden section for each allowance_period
			$output .= "<div class='period-data' id='period-$index' data-period='$index' style='".$style."'>";
			$output .= "<h3>Allowance Period: $index</h3><div class='row'>";

			foreach ($priceplan as $index => $item) {
				//if($item['web_status']==1 && $item['description']!=''){
					$output .= '<div class="col-md-4 mb-4" id="item_' . esc_html($item['id']) . '">'; // 3 columns per row
					$output .= '<div class="card h-100">';
					$output .= '<div class="card-body">';
					$output .= '<h5 class="card-title">' . esc_html($item['title']) . '</h5>';

					$output .= '<p class="card-text card-price"><strong>Value:</strong> ' . esc_html($item['value']) . '</p>';
					$output .= '<p class="card-text card-type"><strong>Type:</strong> ' . esc_html($item['type']) . '</p>';
					$output .= '<p class="card-text card-period"><strong>Monthly/Annually:</strong> ' . esc_html($item['allowance_period']) . '</p>';

					// Add description with Read More button
					$output .= '<div class="description-container">';
						$output .= '<div class="short-description" id="short-desc-' . $index . '">' . wp_trim_words($item['description'], 20, '...') . '</div>';
						$output .= '<div class="full-description" id="full-desc-' . $index . '" style="display: none;">' . $item['description'] . '</div>';
						$output .= '<button class="btn btn-link read-more-btn" data-index="' . $index . '">Read More</button>';
					$output .= '</div>';
					$output .= '<button class="btn get_this_plan" data-id="' . esc_html($item['id']) . '">Get This Plan</button>';
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';
				//}
			}
			$output .= '</div></div>'; // Close Bootstrap row and container
		}
		//$html .= '</div>';
		$html .= $output;
		$html .= '</div>';
		//step 1 end
		$curent_page_url =  get_the_permalink();
		//step 2 start
		$html .= '<div id="step2" class="step2 step_form" data-id="2" style="display:none;">';
		ob_start();
		include locate_template( 'price_plan_template/step2.php' );
		$html .= ob_get_clean();

		/*$html .= '<div id="step2" class="step2 step_form" data-id="2" style="display:none;">
			<h3>Your Details</h3>';
			$html .= '<div class="selected_plan_details">
						<div class="row">
							<div class="col-md-6 mb-3 selected_plan_name_section">
								<img src="" alt="selected plan image" title="selected plan image">
								<h3>Selected Plan</h3>
								<div class="plan_title"></div>
							</div>
							<div class="col-md-6 mb-3 selected_plan_price_section">
								<div class="plan_price"></div>
								<div class="plan_period"></div>
								<a href="'.esc_url($curent_page_url).'">Change Price</a>
							</div>
						</div>';
			$html .= '</div>';
			$html .= '<div class="user_details">
						<div class="row">';
					$html .= '<div class="col-md-6 mb-3 selected_plan_personal_info">';
						$html .= '<h3>Personal Information</h3>';
						$html .= '<!-- First Name -->
						<div class="mb-3">
							<label for="firstName" class="form-label">First Name</label>
							<input type="text" class="form-control" id="firstName" placeholder="Enter your first name" required>
						</div>

						<!-- Surname -->
						<div class="mb-3">
							<label for="surname" class="form-label">Surname</label>
							<input type="text" class="form-control" id="surname" placeholder="Enter your surname" required>
						</div>

						<!-- Mobile Number -->
						<div class="mb-3">
							<label for="mobileNumber" class="form-label">Mobile Number</label>
							<input type="tel" class="form-control" id="mobileNumber" placeholder="Enter your mobile number" required>
						</div>

						<!-- Email -->
						<div class="mb-3">
							<label for="email" class="form-label">Email Address</label>
							<input type="email" class="form-control" id="email" placeholder="Enter your email" required>
						</div>

						<!-- Promo/Referral Code -->
						<div class="mb-3">
							<label for="promoCode" class="form-label">Promo/Referral Code</label>
							<input type="text" class="form-control" id="promoCode" placeholder="Enter promo or referral code">
						</div>';
					$html .= '</div>';
					$html .= '<div class="col-md-6 mb-3 selected_plan_collection_info">';
						$html .= '<h3>Collection Address</h3>
									<!-- Your Address -->
									<div class="mb-3">
										<label for="yourAddress" class="form-label">Your Address</label>
										<input type="text" class="form-control" id="yourAddress" placeholder="Enter your address" required>
									</div>
									<!-- Confirm Address -->
									<div class="mb-3">
										<input type="button" class="form-control" id="confirmAddress" value="Confirm Address">
									</div>

									<!-- House Number -->
									<div class="mb-3">
										<label for="houseNumber" class="form-label">House Number</label>
										<input type="text" class="form-control" id="houseNumber" placeholder="Enter your house number" required>
									</div>

									<!-- Address Line 1 -->
									<div class="mb-3">
										<label for="address1" class="form-label">Address Line 1</label>
										<input type="text" class="form-control" id="address1" placeholder="Enter address line 1" required>
									</div>

									<!-- Address Line 2 -->
									<div class="mb-3">
										<label for="address2" class="form-label">Address Line 2</label>
										<input type="text" class="form-control" id="address2" placeholder="Enter address line 2">
									</div>

									<!-- Address Line 3 -->
									<div class="mb-3">
										<label for="address3" class="form-label">Address Line 3</label>
										<input type="text" class="form-control" id="address3" placeholder="Enter address line 3">
									</div>

									<!-- Address Line 4 -->
									<div class="mb-3">
										<label for="address4" class="form-label">Address Line 4</label>
										<input type="text" class="form-control" id="address4" placeholder="Enter address line 4">
									</div>

									<!-- Eircode -->
									<div class="mb-3">
										<label for="eircode" class="form-label">Eircode</label>
										<input type="text" class="form-control" id="eircode" placeholder="Enter your Eircode" required>
									</div>';

					$html .= '</div>';
				$html .= '</div>';
				$html .= '<div class="row">';
					$html .= '<div class="col-sm-12 mb-3">
						<label class="form-label"><input type="checkbox" name="send_occasional_news" id="send_occasional_news" value="1" required> We would like to send you occasional news about The City Bin co. activities to join our mailing list, simply, tik the box. you can unsubscribe at any time.</label></div>';
					$html .= '<div class="col-sm-12 mb-3">
						<label class="form-label"><input type="checkbox" name="term_condition" id="term_condition" value="1" required> I fully agree to the <a href="">Terms & Conditions</a> of this service</label></div>';
				$html .= '</div>';
				$html .= '<div class="row">';
					$html .= '<div class="col-sm-12 mb-3">
								<h3>Select Payment Method</h3>
								<p>Choose a payment method you will use to make a recurring payment for the bin collections</p>
								</div>';
				$html .= '</div>';
				$html .= '<div class="row">';
					$html .= '<div class="col-sm-12 mb-3">
									<button type="button" id="bank_payment">Direct Debit</button>
									<button type="button" id="recurring_payment">Recurring Card</button>
								</div>';
				$html .= '</div>';
			$html .= '</div>';*/
		$html .= '</div>';
	//step 2 end
		//step 3 start
		$html .= '<div id="step3" class="step3 step_form" data-id="3" style="display:none;">';
		ob_start();
		include locate_template( 'price_plan_template/step3.php' );
		$html .= ob_get_clean();
			/*$html .= '<div class="payment_method direct_bank_payment_method"style="display:none;">';
				$html .= '<h3>Sing Up - Direct Bank</h3>';
					$html .= '<div class="direct_bank_payment_method_details">
						<h2 class="text-center mb-4">Your Bank Details</h2>
						<!-- IBAN -->
						<div class="mb-3">
							<label for="iban" class="form-label">IBAN</label>
							<input type="text" class="form-control" id="iban" placeholder="Enter your IBAN" required>
						</div>

						<!-- Bank Name -->
						<div class="mb-3">
							<label for="bankName" class="form-label">Bank Name</label>
							<input type="text" class="form-control" id="bankName" placeholder="Enter your bank name" required>
						</div>

						<!-- SWIFT/BIC Code -->
						<div class="mb-3">
							<label for="swiftCode" class="form-label">SWIFT/BIC Code</label>
							<input type="text" class="form-control" id="swiftCode" placeholder="Enter your SWIFT/BIC code" required>
						</div>

						<!-- Account Holder -->
						<div class="mb-3">
							<label for="accountHolder" class="form-label">Account Holder Name</label>
							<input type="text" class="form-control" id="accountHolder" placeholder="Enter the account holder\'s name" required>
						</div>
					</div>';
					$html .= '<div class="row">';
					$html .= '<div class="col-sm-12 mb-3">
									<button type="button" id="back_to">Go Back</button>
									<button type="button" id="recurring_payment">Continue</button>
								</div>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="payment_method recurring_payment_method" "style="display:none;"></div>';*/
		$html .= '</div>';
		//step 3 end
    $html .= '</div>'; // Close Bootstrap row and container

    // Add script for Read More / Read Less functionality
    $html .= '<script>
        document.addEventListener("DOMContentLoaded", function() {
			const switchButtons = document.querySelectorAll(".toggle-btn");
			switchButtons.forEach(button => {
				button.addEventListener("click", () => {
					const period = button.getAttribute("data-period");
					document.querySelectorAll(".period-data").forEach(section => {
						section.style.display = "none"; // Hide all sections
					});
					const activeSection = document.querySelector(`#period-${period}`);
					if (activeSection) {
						activeSection.style.display = "block"; // Show clicked section
					}
				});
			});

            const buttons = document.querySelectorAll(".read-more-btn");
            buttons.forEach(button => {
                button.addEventListener("click", function() {
                    const index = this.getAttribute("data-index");
                    const shortDesc = document.getElementById("short-desc-" + index);
                    const fullDesc = document.getElementById("full-desc-" + index);
                    if (fullDesc.style.display === "none") {
                        fullDesc.style.display = "block";
                        shortDesc.style.display = "none";
                        this.textContent = "Read Less";
                    } else {
                        fullDesc.style.display = "none";
                        shortDesc.style.display = "block";
                        this.textContent = "Read More";
                    }
                });
            });
        });
    </script>
	<style>
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

	</style>'."<script>" . get_switch_js_script() . "</script>";

    return $html;

}
add_shortcode('display_json_data', 'display_json_data_shortcode');

function get_switch_js_script() {
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

function enqueue_bootstrap_styles() {
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', [], '4.5.2');
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_styles');

function fetch_price_plans_with_highest_price_grouped() {
    // Define the API endpoint and headers
    $url = 'https://thorntonsrecycling.wis.ie/WIS/rest/api/pricePlans';
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
