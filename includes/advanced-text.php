<?php

class cfs_advanced_text extends cfs_field {

	/**
	 * Set some field information
	 */
	function __construct() {
		$this->name  = 'advanced_text';
		$this->label = __( 'Text (Advanced)', 'cfs_advanced_text' );
	}

	/**
	 * Define the field's HTML
	 *
	 * @param $field
	 */
	function html( $field ) {
		$attributes[] = 'type="' . $field->options['type'] . '"';
		$attributes[] = 'name="' . $field->input_name . '"';
		$attributes[] = 'class="' . $field->input_class . '"';
		$attributes[] = 'value="' . $field->value . '"';

		if ( isset( $field->options['pattern'] ) && ! empty( $field->options['pattern'] ) )
			$attributes[] = 'pattern="' . $field->options['pattern'] . '"';

		if ( isset( $field->options['placeholder'] ) && ! empty( $field->options['placeholder'] ) )
			$attributes[] = 'placeholder="' . $field->options['placeholder'] . '"';

		if ( isset( $field->options['maxlength'] ) && ! empty( $field->options['maxlength'] ) )
			$attributes[] = 'maxlength="' . $field->options['maxlength'] . '"';

		if ( isset( $field->required ) && $field->required != false )
			$attributes[] = 'required';

		// Set number field attributes
		if ( $field->options['type'] == 'number' ) {

			if ( isset( $field->options['max'] ) && ! empty( $field->options['max'] ) )
				$attributes[] = 'max="' . $field->options['max'] . '"';

			if ( isset( $field->options['min'] ) && ! empty( $field->options['min'] ) )
				$attributes[] = 'min="' . $field->options['min'] . '"';

			if ( isset( $field->options['step'] ) && ! empty( $field->options['step'] ) )
				$attributes[] = 'step="' . $field->options['step'] . '"';
		}

		echo '<input ' . implode( $attributes, ' ' ) . '>';
	}

	/**
	 * Set up the HTML for the field options
	 *
	 * @param string $key
	 * @param $field
	 */
	function options_html( $key, $field ) {
		if ( $this->get_option( $field, 'type' ) == 'number' ) {
			$number_option_display = 'style="display: unset;"';
		} else {
			$number_option_display = 'style="display: none;"';
		}
	?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Type', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'        => 'select',
					'input_name'  => "cfs[fields][$key][options][type]",
					'options'     => array(
						'choices' => array(
							'text'   => 'text',
							'email'  => 'email',
							'number' => 'number',
							'tel'    => 'tel',
							'url'    => 'url',
						),
						'force_single' => true,
					),
					'value' => $this->get_option( $field, 'type', 'text' ),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Default Value', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'       => 'text',
					'input_name' => "cfs[fields][$key][options][default_value]",
					'value'      => $this->get_option( $field, 'default_value' ),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Placeholder', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'       => 'text',
					'input_name' => "cfs[fields][$key][options][placeholder]",
					'value'      => $this->get_option( $field, 'placeholder' ),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Required', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'        => 'true_false',
					'input_name'  => "cfs[fields][$key][options][required]",
					'input_class' => 'true_false',
					'value'       => $this->get_option( $field, 'required' ),
					'options'     => array(
						'message' => __( 'This is a required field', 'cfs' )
					),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Validation Pattern', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'       => 'text',
					'input_name' => "cfs[fields][$key][options][pattern]",
					'value'      => $this->get_option( $field, 'pattern' ),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e( 'Max Length', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'       => 'text',
					'input_name' => "cfs[fields][$key][options][maxlength]",
					'value'      => $this->get_option( $field, 'maxlength' ),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_cfsatf_number field_option_<?php echo $this->name; ?>" <?php echo $number_option_display; ?>>
			<td class="label">
				<label><?php _e( '<strong>Number:</strong> Min', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'       => 'text',
					'input_name' => "cfs[fields][$key][options][min]",
					'value'      => $this->get_option( $field, 'min' ),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_cfsatf_number field_option_<?php echo $this->name; ?>" <?php echo $number_option_display; ?>>
			<td class="label">
				<label><?php _e( '<strong>Number:</strong> Max', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'       => 'text',
					'input_name' => "cfs[fields][$key][options][max]",
					'value'      => $this->get_option( $field, 'max' ),
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_cfsatf_number field_option_<?php echo $this->name; ?>" <?php echo $number_option_display; ?>>
			<td class="label">
				<label><?php _e( '<strong>Number:</strong> Step', 'cfs' ); ?></label>
			</td>
			<td>
				<?php
				CFS()->create_field( array(
					'type'       => 'text',
					'input_name' => "cfs[fields][$key][options][step]",
					'value'      => $this->get_option( $field, 'step' ),
				));
				?>
			</td>
		</tr>
	<?php
	}

}
