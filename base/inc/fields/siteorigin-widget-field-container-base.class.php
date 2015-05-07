<?php

/**
 *
 * The common base class for fields which may contain and render other fields.
 *
 * Class SiteOrigin_Widget_Field_Container_Base
 */
abstract class SiteOrigin_Widget_Field_Container_Base extends SiteOrigin_Widget_Field {
	/**
	 * The child field options.
	 *
	 * @access protected
	 * @var array
	 */
	protected $sub_field_options;
	/**
	 * The child field instances.
	 *
	 * @access protected
	 * @var array
	 */
	protected $sub_fields;
	/**
	 * Reference to the parent widget required for creating child fields.
	 *
	 * @access private
	 * @var SiteOrigin_Widget
	 */
	protected $for_widget;
	/**
	 * An array of field names of parent containers.
	 *
	 * @var array
	 */
	protected $parent_container;

	public function __construct( $base_name, $element_id, $element_name, $field_options, SiteOrigin_Widget $for_widget, $parent_container = array()  ) {
		parent::__construct( $base_name, $element_id, $element_name, $field_options );

		$this->for_widget = $for_widget;
		$this->parent_container = $parent_container;

		if( isset( $field_options['fields'] ) ) $this->sub_field_options = $field_options['fields'];
	}

	protected function create_and_render_sub_fields( $values, $parent_container = null, $is_template = false ) {
		$this->sub_fields = array();
		if( isset( $parent_container ) ) {
			$this->parent_container[] = $parent_container;
		}
		foreach( $this->sub_field_options as $sub_field_name => $sub_field_options ) {
			/* @var $field SiteOrigin_Widget_Field */
			$field = SiteOrigin_Widget_Field_Factory::create_field(
				$sub_field_name,
				$sub_field_options,
				$this->for_widget,
				$this->parent_container,
				$is_template
			);
			$sub_value = ( ! empty( $values ) && isset( $values[$sub_field_name] ) ) ? $values[$sub_field_name] : null;
			$field->render( $sub_value );
			$field_js_vars = $field->get_javascript_variables();
			if( ! empty( $field_js_vars ) ) {
				$this->javascript_variables[$sub_field_name] = $field_js_vars;
			}
			$this->sub_fields[$sub_field_name] = $field;
		}
	}

	protected function sanitize_field_input( $value ) {
		foreach( $this->sub_field_options as $sub_field_name => $sub_field_options ) {
			if( empty( $value[$sub_field_name] ) ) continue;
			/* @var $sub_field SiteOrigin_Widget_Field */
			if( ! empty( $this->sub_fields ) && ! empty( $this->sub_field_options[$sub_field_name] ) ) {
				$sub_field = $this->sub_fields[$sub_field_name];
			}
			else {
				$sub_field = SiteOrigin_Widget_Field_Factory::create_field(
					$this->base_name . '][' . $sub_field_name,
					$sub_field_options,
					$this->for_widget,
					$this->parent_container
				);
			}
			$value[$sub_field_name] = $sub_field->sanitize( $value[$sub_field_name], $value );
		}

		return $value;
	}

}