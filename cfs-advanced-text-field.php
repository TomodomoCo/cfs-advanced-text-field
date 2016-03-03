<?php
/*
Plugin Name: CFS Advanced Text Field
Plugin URI: http://customfieldsuite.com/
Description: Text field type for Custom Field Suite with additional customisation options
Version: 1.1.1
Author: Van Patten Media Inc.
Author URI: https://www.vanpattenmedia.com/
Text Domain: cfs_advanced_text
*/

class CfsAdvancedTextField {

	/**
	 * Get this party started
	 */
	function __construct() {
		// Register our fields
		add_filter( 'cfs_field_types', array( $this, 'cfs_field_types' ) );
	}

	/**
	 * Append our field to the field types array
	 *
	 * @param array $field_types
	 *
	 * @return array
	 */
	function cfs_field_types( array $field_types ) {
		// Add the advanced text field
		$field_types['advanced_text'] = dirname( __FILE__ ) . '/includes/advanced-text.php';

		// Return field types
		return $field_types;
	}

}

new CfsAdvancedTextField;
