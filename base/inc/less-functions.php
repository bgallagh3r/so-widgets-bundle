<?php

/**
 * Class siteorigin_lessc
 *
 * An extension to the lessc class that adds a few custom functions
 */
class SiteOrigin_Widgets_Less_Functions {

	private $widget;
	private $widget_instance;

	function __construct($widget, $widget_instance){
		$this->widget = $widget;
		$this->widget_instance = $widget_instance;
	}

	/**
	 * @param lessc $c
	 *
	 * Register less functions in a lessc object
	 */
	function registerFunctions(&$c){
		$c->registerFunction( 'length', array($this, 'length') );
		$c->registerFunction( 'widget-function', array($this, 'callWidgetFunction') );
	}

	/**
	 * Very basic length function that checks the length of a list. Might need some more checks for other types.
	 *
	 * @param $arg
	 *
	 * @return int
	 */
	function length($arg){
		if(empty($arg[0]) || empty($arg[2]) || $arg[0] != 'list') return 1;
		return count($arg[2]);
	}

	/**
	 * Let LESS easily call a widget function.
	 *
	 * @param $arg
	 *
	 * @return mixed
	 */
	function callWidgetFunction( $arg ) {
		// This needs to be done.
		// Maybe make it possible to have extra arguments
		return call_user_func(array($this->widget_instance, $arg[0]), $this->widget_instance);
	}

}