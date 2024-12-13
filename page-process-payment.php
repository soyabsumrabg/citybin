<?php
if ( isset( $_POST['process_payment_field'] ) && wp_verify_nonce( $_POST['process_payment_field'], 'process_payment_action' )) {
	global $wpdb;
	$table = $wpdb->prefix . 'citybin_customer_transaction_data';
	$payToken = $_POST['google-pay-token'] ??  '';
	$reference = $_POST['reference'] ?? '';
	$cardType = $_POST['cardType'] ?? '';
	$card_preview_digits = $_POST['cardNumber'] ?? '';
	$expiryMonth = $_POST['expiryMonth'] ?? '';
	$expiryYear = $_POST['expiryYear'] ??  '';
	$selected_plan_price = $_POST['selected_plan_price'] ?? 0;
	$plan_price = str_replace( '€ ', '', $selected_plan_price);
	if(!empty($payToken)){
		// API endpoint
		$permissions = '';
		$get_globalpay_access_token = get_globalpay_access_token($permissions);
		$auth_token = $get_globalpay_access_token['body'] ?? [];
		$token = $auth_token['token'] ?? '';
		$account_id = $auth_token['scope']['accounts'][2]['id'] ?? '';
		$merchant_id = $auth_token['scope']['merchant_id'] ?? '';
		$formattedAmount = intval($plan_price * 100); // Convert to integer (e.g., 1899)
		// Request body
		$body = array(
			'account_name' => 'transaction_processing',
			'type'         => 'SALE',
			'channel'      => 'CNP',
			'amount'       => $formattedAmount,
			'currency'     => 'EUR',
			'reference'    => $reference,
			'country'      => 'IE',
			'account_id'   => $account_id,
			'merchant_id'  => $merchant_id,
			'payment_method' => array(
				'name'          => 'john doi',
				'entry_mode'    => 'ECOM',
				'id'    		=> $payToken,
			),
		);
		// Global payment transaction API request
		$response = citybin_globalpay_transaction_request_send($body, $token);
		// Handle the response
		if (is_wp_error($response)) {
			return 'Error: ' . $response->get_error_message();
		}

		$response_body = wp_remote_retrieve_body($response);
		$response_code = wp_remote_retrieve_response_code($response);
		$globalpay_transection_response = $response_body;
		//echo '<pre>',print_r($body),'</pre>';
		//echo '<pre>',print_r($globalpay_transection_response),'</pre>';
		$result = array(
			'code'    => $response_code,
			'body'    => json_decode($response_body, true),
		);
		$response_body = json_decode($response_body, true);
		$trnsction_id = $response_body['id'] ?? 0;
		if(isset($response_body['status']) && ($response_body['status']=='CAPTURED' || $response_body['status']=='SUCCESS')){
			$card_type_id = 0;
			if($cardType=='VISA'){
				$card_type_id = 5;
			}elseif($cardType=='MASTERCARD'){
				$card_type_id = 6;
			}
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
			$transction_description = $plan_id.' - '.$plan_title.' - '.$plan_price;

			$plan_period = sanitize_text_field($_POST['selected_plan_period'] ?? '');

			$iban = sanitize_text_field($_POST['iban'] ?? '');
			$bankName = sanitize_text_field($_POST['bankName'] ?? '');
			$swift = sanitize_text_field($_POST['swift'] ?? '');
			$accountHolder = sanitize_text_field($_POST['accountHolder'] ?? '');
			$card_preview_digits = sanitize_text_field($_POST['card_preview_digits'] ?? '');

			//citybin custom create API
			$email = 'pointblankire@gmail.com';
			$firstName = 'DevTestFirstname';
			$surname = 'DevTestSurname';
			$name = implode( ' ', array($firstName,$surname));
			// Define the body of the request
			$body = array(
				"status" => 1,
				"type" => 1,
				"route_id" => null,
				"pay_plan" => $plan_id,
				"pay_months" => $plan_period,
				"payment_method" => 1,
				"sales_agent" => 0,
				"email" => $email,
				"mobile" => $mobileNumber,
				"password" => "",
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
				"payment_card_token" => $payToken,
				"card_preview_digits" => $card_preview_digits,
				"card_type_id" => $card_type_id,
				"is_default" => 1,
				"recurring_status" => 1,
				"last_invoice_amount" => $plan_price,
			);

			$response = citybin_customer_create( $body );

			// Check for errors
			if (is_wp_error($response)) {
				return $response->get_error_message();
			}else{
				//citybin custom create API response
				$customer_response_body =  wp_remote_retrieve_body($response);
				$response_data = json_decode($customer_response_body, true);
				$ref_id = $response_data['data']['ref_id'] ?? 0;
				if (isset($response_data['status']) && $response_data['status']==true) {
					//citybin transaction API
					$body = array(
						'customer_id'        => $ref_id,
						'company_id'         => null,
						'reg_date'           => date('Y-m-d'),
						'credit'             => $plan_price,
						'transaction_id'     => $trnsction_id,
						'description'        => $transction_description,
					);
					$transaction_api_response_body = citybin_transaction_request_send($body);
					$citybin_transaction_response = json_decode($transaction_api_response_body, true);
					if (isset($citybin_transaction_response['status']) && $citybin_transaction_response['status']==true) {
						//after success add response to db
						$wpdb->insert($table,
							array(
								'ref_id' => $ref_id,
								'customer_response' => $customer_response_body,
								'transaction_response' => $transaction_api_response_body,
								'globalpay_transaction_response' => $globalpay_transection_response,
							)
						);

						//after success thank you message with information.
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
						//citybin_add_subscriber_to_mailchimp($email, $firstName, $surname);
						//citybin_send_email($email, $name, $plan_title);
						if(!empty($promoCode)){
							citybin_referral_code_apply($ref_id, 'referral_code', $promoCode);
						}
						wp_send_json_success(['message' => $message]);
					}else{
						//return $response_data['errors'];  // Return the error message
						if(isset($citybin_transaction_response['errors']) && $citybin_transaction_response['errors']!=''){
							return wp_send_json_error(['error' => $citybin_transaction_response['errors'][0]]);
						}elseif(isset($citybin_transaction_response['message']) && $citybin_transaction_response['message']!=''){
							return wp_send_json_error(['error' => $citybin_transaction_response['message']]);
						}
						return wp_send_json_error(['error' => $citybin_transaction_response['message']]);
					}
				}else{
					//return $response_data['errors'];  // Return the error message
					if(isset($response_data['errors']) && $response_data['errors']!=''){
						return wp_send_json_error(['error' => $response_data['errors'][0]]);
					}elseif(isset($response_data['message']) && $response_data['message']!=''){
						return wp_send_json_error(['error' => $response_data['message']]);
					}
					return wp_send_json_error(['error' => $response_data['message']]);
				}
			}
		}elseif(isset($response_body['status']) && $response_body['status']=='DECLINED'){
			return wp_send_json_error(['error' => $response_body['payment_method']['message']]);
		}elseif(isset($response_body['status']) && $response_body['status']=='ERROR'){
			return wp_send_json_error(['error' => $response_body['message']]);
		}
	}
}else{
	ob_start();
	$redirect_page = site_url().'/sample-page/';
	wp_redirect($redirect_page);
	exit;
}
?>