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
	$json_content = fetch_price_plans_with_highest_price();
    $data = json_decode($json_content, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return '<p>Invalid JSON format.</p>';
    }

    // Build the Bootstrap grid layout with Read More toggle
    $output = '<div class="container"><h3 class="text-center">Price Plan</h3><div class="row">';
    foreach ($data as $index => $item) {
		if($item['web_status']==1 && $item['description']!=''){
			$output .= '<div class="col-md-4 mb-4">'; // 3 columns per row
			$output .= '<div class="card h-100">';
			$output .= '<div class="card-body">';
			$output .= '<h5 class="card-title">' . esc_html($item['title']) . '</h5>';

			$output .= '<p class="card-text"><strong>Value:</strong> ' . esc_html($item['value']) . '</p>';
			$output .= '<p class="card-text"><strong>Type:</strong> ' . esc_html($item['type']) . '</p>';
			$output .= '<p class="card-text"><strong>Monthly/Annually:</strong> ' . esc_html($item['allowance_period']) . '</p>';

			// Add description with Read More button
			$output .= '<div class="description-container">';
			$output .= '<div class="short-description" id="short-desc-' . $index . '">' . wp_trim_words($item['description'], 20, '...') . '</div>';
			$output .= '<div class="full-description" id="full-desc-' . $index . '" style="display: none;">' . $item['description'] . '</div>';
			$output .= '<button class="btn btn-link read-more-btn" data-index="' . $index . '">Read More</button>';
			$output .= '</div>';

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}
    }
    $output .= '</div></div>'; // Close Bootstrap row and container

    // Add script for Read More / Read Less functionality
    $output .= '<script>
        document.addEventListener("DOMContentLoaded", function() {
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
    </script>';

    return $output;

}
add_shortcode('display_json_data', 'display_json_data_shortcode');

function enqueue_bootstrap_styles() {
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', [], '4.5.2');
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_styles');


function fetch_price_plans_with_highest_price() {
    // Define the API endpoint and headers
    $url = 'https://thorntonsrecycling.wis.ie/WIS/rest/api/pricePlans';
    $headers = array(
        'Authorization' => 'Basic cG9pbnRibGFua191c2VyOmNcPlAsV3EzZjdaenY4Ww==',
        'Cookie' => 'PHPSESSID=emrv025tcs22m9tij0o0vp4dq1',
    );

    // Perform the request
    $response = wp_remote_get($url, array(
        'headers' => $headers,
        'timeout' => 10,
    ));

    // Check for errors
    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    }

    // Decode the JSON response
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
	echo '<pre>',print_r($data),'</pre>'; exit;
    if (!is_array($data)) {
        return 'Invalid response format.';
    }

    // Filter records to get the highest price for each title
    $filtered_data = array();

    foreach ($data['data'] as $record) {
		//echo '<pre>',print_r($record),'</pre>';
        /*$title = trim($record['title']); // Adjust the key to match your API's response structure
        $price = $record['value']; // Adjust the key to match your API's response structure
        // Ensure the title exists in filtered data or update it with a higher price
		$allowance_period = $record['allowance_period'];
        if (!isset($filtered_data[$title]) || $price > $filtered_data[$title]['value']) {
            $filtered_data[$title] = $record;
        }*/
        $allowance_period = $record['allowance_period']; // Adjust the key to match your API's response structure
        $title = $record['title']; // Adjust the key to match your API's response structure
        $price = $record['value']; // Adjust the key to match your API's response structure

        // Ensure the group for the allowance_period exists
        if (!isset($grouped_data[$allowance_period])) {
            $grouped_data[$allowance_period] = array();
        }

        // Ensure the title exists in the current group or update it with a higher price
        if (
            !isset($grouped_data[$allowance_period][$title]) ||
            $price > $grouped_data[$allowance_period][$title]['value']
        ) {
            $grouped_data[$allowance_period][$title] = $record;
        }
    }

    $filtered_data = array();
    foreach ($grouped_data as $allowance_period => $titles) {
		foreach ($titles as $record) {
			$title = trim($record['title']); // Adjust the key to match your API's response structure
			$price = $record['value']; // Adjust the key to match your API's response structure
			// Ensure the title exists in filtered data or update it with a higher price
			if (!isset($filtered_data[$allowance_period][$title]) || $price > $filtered_data[$allowance_period][$title]['value']) {
				$filtered_data[$allowance_period][$title] = $record;
			}
		}
    }

    // Return the filtered data
    return json_encode(array_values($filtered_data), JSON_PRETTY_PRINT);
}