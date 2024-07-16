<?php

/**
 * Sync with MailChimp
 */

function dmt_sync_mailchimp( $MailchimpAPI, $MailchimpLID, $data ) {

	$memberId = md5( strtolower( $data['email'] ) );
	$dataCenter = substr( $MailchimpAPI, strpos( $MailchimpAPI, '-' ) +1 );
	$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $MailchimpLID . '/members/' . $memberId;

	$body = json_encode(array(
		'email_address'	=> $data['email'],
		'status'		=> $data['status'], // "subscribed","unsubscribed","cleaned","pending"
		'merge_fields'	=> array(
			'FNAME'		=> $data['fname'],
			'LNAME'		=> $data['lname']
		)
	));

	$args = array(
		'method' => 'PUT',
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'user:'. $MailchimpAPI ),
			'Content-Type' => 'application/json',
		),
		'body' => $body
	);

	$postRequest = wp_remote_post( $url, $args );

	return $postRequest;
}

/**
 * MailChimp handler with ajax request
 * @return array stats and message
 */
function dmt_mailchimp_subscribe() {

	// API and List ID
	$APIKey 	= get_theme_mod( 'dmt_mailchimp_api_key' );
	$ListID 	= get_theme_mod( 'dmt_mailchimp_api_list' );

	$data 			= array(
		'email'		=> sanitize_email( $_REQUEST['email'] ),
		'fname'		=> esc_html( $_REQUEST['fname'] ),
		'lname'		=> esc_html( $_REQUEST['lname'] ),
		'status'	=> 'subscribed' // "subscribed","unsubscribed","cleaned","pending"
	);

	$prepareResponse = array(
		'error'			=> false,
		'email_valid'	=> true,
		'api'			=> true,
		'list'			=> true,
		'message'		=> esc_html__( 'Somethings is wrong!', 'gmart-core' )
	);

	if ( ! empty( $APIKey ) && ! empty( $ListID ) ) {

		if ( ! empty( $_REQUEST['email'] ) ) {

			$makeRequest = dmt_sync_mailchimp( $APIKey, $ListID, $data );
			$getStatus = wp_remote_retrieve_response_code( $makeRequest );

			if ( $getStatus == 200 ) {
				$prepareResponse['error'] 		= false;
				$prepareResponse['email_valid'] = true;
				$prepareResponse['message'] 	= '<strong>' . esc_html__( 'Success:', 'gmart-core') . ' </strong>' . esc_html__( 'You are added to our newsletter list.', 'gmart-core' );
			} else {
				$prepareResponse['error'] 		= true;
				$prepareResponse['email_valid'] = false;
				$prepareResponse['message'] 	= '<strong>' . esc_html__( 'Error:', 'gmart-core') . ' </strong>' . esc_html__( 'You have entered the invalid email address.', 'gmart-core' );
			}

		} else {
			$prepareResponse['error'] 		= true;
			$prepareResponse['email_valid'] = false;
			$prepareResponse['message'] 	= '<strong>' . esc_html__( 'Error:', 'gmart-core') . ' </strong>' . esc_html__( 'Please provide a email address.', 'gmart-core' );

		}

	} else {

		$prepareResponse = array(
			'error'			=> true,
			'email_valid'	=> false,
			'api'			=> false,
			'list'			=> false,
			'message'		=> '<strong>' . esc_html__( 'Error:', 'gmart-core') . ' </strong>' . esc_html__( 'Newsletter widget is require MailChimp API key & list ID.', 'gmart-core' )
		);

	}

	// Return Data
	return $prepareResponse;
}

// Action it for ajax request
add_action( 'wp_ajax_nopriv_dmt_mailchimp_subscribe', function() {

	header('Content-type: application/json');
	echo json_encode( dmt_mailchimp_subscribe() );
	die();

});
add_action( 'wp_ajax_dmt_mailchimp_subscribe', function() {

	header('Content-type: application/json');
	echo json_encode( dmt_mailchimp_subscribe() );
	die();
});