<?php 
/*
	Plugin Name: Twitter API Wrapper
	Description: A simple wrapper for using TwitterOAuth in WordPress
	Version: 1.0
	Author: Daniel Homer | Abraham Williams
	Author URI: https://github.com/abraham/twitteroauth
 */

require_once( 'twitteroauth/twitteroauth.php' );

add_action( 'wp_ajax_twitter_api', array( 'twitter_api', 'response' ) );
add_action( 'wp_ajax_nopriv_twitter_api', array( 'twitter_api', 'response' ) );

class twitter_api {

	public static function response() {
		require_once( 'accounts.php' );

		$account = isset( $_POST[ 'account' ] ) ? $_POST[ 'account' ] : false;
		$query   = isset( $_POST[ 'query' ] ) ? $_POST[ 'query' ] : false;
		$args    = isset( $_POST[ 'args' ] ) ? $_POST[ 'args' ] : false;

		if ( ! $account || ! array_key_exists( $account, $accounts ) ) {
			echo json_encode( array( 'error' => 'Invalid account or account not set' ) );
			return;
		}

		if ( ! $query ) {
			echo json_encode( array( 'error' => 'Query not set' ) );
			return;
		}

		if ( ! $args ) {
			echo json_encode( array( 'error' => 'Arguments not set' ) );
			return;
		}

		$credentials = $accounts[ $account ];

		$connection = new TwitterOAuth( $credentials['consumer_key'], $credentials['consumer_secret'], $credentials['access_token'], $credentials['access_token_secret'] );
		echo $connection->get( $query, $args );

		die();
	}

}

?>