<?php
/*
 * Plugin Name: Extra Fee on cart for WooCommerce
 * Plugin URI: https://www.premtiwari.in/
 * Description: This plugin will allow you to add an extra fee with order to WooCommerce store.
 * Version: 1.3.0
 * Author: Prem Tiwari
 * Author URI: https://www.premtiwari.in/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin name
define( 'wc_extra_fee', 'Extra Fee Options' );
// Define plugin version
define( 'wc_version_extra_fee', '1.3.0' );

// Checks if the WooCommerce plugins is installed and actived.
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( is_admin() ) {
	include_once( 'admin/settings.php' );
}

$fmrf_options = get_option( 'wcef_settings' );

add_action( 'admin_head', 'fm_extra_fee_style' );

function fm_extra_fee_style() {
	wp_enqueue_style( 'fm_extra_fee_style', plugins_url( "css/style.css", __FILE__ ) );
}

/**
 * Add wc_extra_fee function.
 */
function wc_add_extra_fee() {
	global $woocommerce;
	global $fmrf_options;
	$fm_fee_type = $fmrf_options[ 'fm_fee_type' ];
	$fm_amount   = $fmrf_options[ 'fm_amount' ];
	$cart_total  = WC()->cart->cart_contents_total;

	// check extra fee type Fixed/percentage.
	if ( $fm_fee_type == "percentage" ) {
		$fm_amount = $cart_total * $fm_amount / 100;
	}
	$woocommerce->cart->add_fee( __( $fmrf_options[ 'fm_label' ], 'woocommerce' ), $fm_amount );
}

add_action( 'woocommerce_cart_calculate_fees', 'wc_add_extra_fee' );
