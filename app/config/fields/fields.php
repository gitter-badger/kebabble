<?php namespace kebabble\config\fields;

defined( 'ABSPATH' ) or die( 'Operation not permitted.' );

class fields {
	/**
	 * Provides a clean way of accessing specific ACF data when their API is unavailable.
	 * @param array $_POST["fields"]
	 * @return stdClass
	 */
	public function processOrderResponse($response) {
		$format = new \stdClass();
		$format->override = $this->isChecked( $response["field_5a1446fb18a6c"] );
		$format->message  = $response["field_5a14475e0c1ea"];
		$format->food     = (empty($response["field_5a1c19fa8cc47"])) ? $response["field_5a1c16a61e789"] : $response["field_5a1c19fa8cc47"]; 
		$format->order    = $response["field_5a14314fa1666"];
		$format->driver   = $response["field_5a1565db084b6"];
		$format->payment  = $response["field_5a158d7240fa8"];
		return $format;
	}
	
	/**
	 * Sets up the custom ACF fields for the Order post type.
	 * @return void
	 */
	public function orderOptions() {
		/**
		 * Generated from ACF Export tool.
		 */
		if(function_exists("register_field_group"))
		{
			register_field_group(array (
				'id' => 'acf_kebabble-order-definitions',
				'title' => 'Kebabble Order Definitions',
				'fields' => array (
					array (
						'key' => 'field_5a1446fb18a6c',
						'label' => 'Custom Message',
						'name' => 'tick_custom_message',
						'type' => 'checkbox',
						'choices' => array (
							'Enabled' => 'Enabled',
						),
						'default_value' => '',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_5a14475e0c1ea',
						'label' => 'Message',
						'name' => 'custom_message',
						'type' => 'textarea',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a1446fb18a6c',
									'operator' => '==',
									'value' => 'Enabled',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_5a1c16a61e789',
						'label' => 'Food',
						'name' => 'ordering_type',
						'type' => 'select',
						'choices' => array (
							'Kebab' => 'Kebab',
							'Pizza' => 'Pizza',
							'Burger' => 'Burger',
							'Resturant' => 'Resturant',
							'Event' => 'Event',
							'Other' => 'Other',
						),
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a1446fb18a6c',
									'operator' => '!=',
									'value' => 'Enabled',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5a1c19fa8cc47',
						'label' => 'Other food...',
						'name' => 'ordering_type_other',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a1c16a61e789',
									'operator' => '==',
									'value' => 'Other',
								),
								array (
									'field' => 'field_5a1446fb18a6c',
									'operator' => '!=',
									'value' => 'Enabled',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a14314fa1666',
						'label' => 'Orders',
						'name' => 'ordering_orderlist',
						'type' => 'textarea',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a1446fb18a6c',
									'operator' => '!=',
									'value' => 'Enabled',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_5a1565db084b6',
						'label' => 'Driver',
						'name' => 'ordering_driver',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a1446fb18a6c',
									'operator' => '!=',
									'value' => 'Enabled',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5a158d7240fa8',
						'label' => 'Payment Methods',
						'name' => 'ordering_payment',
						'type' => 'checkbox',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5a1446fb18a6c',
									'operator' => '!=',
									'value' => 'Enabled',
								),
							),
							'allorany' => 'all',
						),
						'choices' => array (
							'Cash' => 'Cash',
							'Monzo' => 'Monzo',
							'PayPal' => 'PayPal',
						),
						'default_value' => 'Cash',
						'layout' => 'horizontal',
					)
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'kebabble_orders',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
		}
	}

	/**
	 * Checks if the ACF field is checked or not.
	 * @param mixed $field
	 * @return boolean
	 */
	private function isChecked($field) {
		if($field !== "") {
			if ($field[0] == "Enabled") {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}