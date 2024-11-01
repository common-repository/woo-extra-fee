<?php
/**
 * Uses the WooCommerce admin settings page.
 * @author Prem Tiwari
 */

add_action( 'admin_menu', 'fm_wc_extra_fee', 99 );

function fm_wc_extra_fee() {
	add_submenu_page( 'woocommerce', 'Woocommerce Extra Fee Setting Page', wc_extra_fee, 'manage_options', 'wc-extra-fee', 'fm_extra_fee_init' );
}

function fm_extra_fee_init() {
	global $fmrf_options;
	?>
	<div>
		<h2 class="smsb_pluginheader"><?php _e( "Settings - WooCommerce Extra Fee Option Lite", wc_extra_fee ); ?></h2>
		<?php _e( "<p>Allow you to add extra fee with every orders from your WooCommerce store.</p>", wc_extra_fee ); ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'fm_settings_group' ); ?>
			<hr>
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="fm_enabled">Enable/Disable</label>
					</th>
					<td class="forminp">
						<fieldset>
							<legend class="screen-reader-text"><span>Enable/Disable</span></legend>
							<label for="wcef_settings[fm_enabled]">
								<input type="checkbox" name="wcef_settings[fm_enabled]" id="wcef_settings[fm_enabled]"
									   value="1" <?php checked( 1, isset( $fmrf_options[ 'fm_enabled' ] ) ); ?>>
							</label><br>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcef_settings[fm_label]">Label</label>
					<td class="forminp">
						<fieldset>
							<input class="regular-input" type="text" name="wcef_settings[fm_label]"
								   id="wcef_settings[fm_label]" value="<?php echo $fmrf_options[ 'fm_label' ]; ?>">
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcef_settings[fm_amount]">Amount</label></th>
					<td class="forminp">
						<fieldset>
							<input class="regular-input" type="text" name="wcef_settings[fm_amount]"
								   id="wcef_settings[fm_amount]" value="<?php echo $fmrf_options[ 'fm_amount' ]; ?>">
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcef_settings[fm_fee_type]">Extra Fee Type</label>
					<td class="forminp">
						<fieldset>
							<select name="wcef_settings[fm_fee_type]">
								<option value="fixed" <?php if ( $fmrf_options[ 'fm_fee_type' ] == 'fixed' ) {
									echo 'selected="selected"';
								} ?>><?php _e( 'Fixed Fee', 'WC Extra Fee' ); ?></option>
								<option value="percentage" <?php if ( $fmrf_options[ 'fm_fee_type' ] == 'percentage' ) {
									echo 'selected="selected"';
								} ?>><?php _e( 'Percentage(%)', 'WC Extra Fee' ); ?></option>
							</select>
						</fieldset>
					</td>
				</tr>
				</tbody>
			</table>
			<p>&nbsp;</p>
			<p><input type="submit" name="Submit" class="button-primary"
					  value="<?php _e( "Save Settings", wc_extra_fee ); ?>"></p>
		</form>
	</div>
	<?php
}

function fm_extra_fee_register_settings() {
	register_setting( 'fm_settings_group', 'wcef_settings' );
}

add_action( 'admin_init', 'fm_extra_fee_register_settings' );