<?php
/**
 * Register or unregister widget areas through configuration.
 *
 * @package   D2\Core
 * @author    Craig Simpson <craig@craigsimpson.scot>
 * @copyright 2018, Craig Simpson
 * @license   MIT
 */

namespace D2\Core;

/**
 * Register or unregister widget areas through configuration.
 *
 * Example config (usually located at config/defaults.php):
 *
 * ```
 * use D2\Core\WidgetArea;
 *
 * $d2_widget_areas = [
 *     WidgetArea::REGISTER   => [
 *         [
 *             'id' => 'utility-bar',
 *             'name' => __( 'Header Utility Bar', 'example-textdomain' ),
 *             'description' => __( 'Utility bar area appearing above the site header.', 'example-textdomain' ),
 *         ],
 *     ],
 *     WidgetArea::UNREGISTER => [
 *         WidgetArea::HEADER_RIGHT,
 *         WidgetArea::SIDEBAR_ALT,
 *     ],
 * ];
 *
 * return [
 *     WidgetArea::class => $d2_widget_areas,
 * ];
 * ```
 *
 * @package D2\Core
 */
class WidgetArea extends Core {

	const REGISTER     = 'register';
	const UNREGISTER   = 'unregister';
	const HEADER_RIGHT = 'header-right';
	const SIDEBAR      = 'sidebar';
	const SIDEBAR_ALT  = 'sidebar-alt';

	/**
	 * Register or unregister widget areas through configuration.
	 *
	 * @return void
	 */
	public function init() {
		if ( array_key_exists( self::REGISTER, $this->config ) ) {

			/**
			 * Check for Genesis child theme.
			 *
			 * If this component is being used to register widget areas in a Genesis
			 * child theme, then we should use the Genesis specific function to ensure
			 * the correct markup is output.
			 *
			 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
			 * @link genesis/lib/functions/widgetize.php.
			 */
			$theme             = wp_get_theme();
			$register_function = 'genesis' === $theme->get( 'Template' ) ? 'genesis_register_widget_area' : 'register_sidebar';
			array_map( $register_function, $this->config[ self::REGISTER ] );
		}

		if ( array_key_exists( self::UNREGISTER, $this->config ) ) {
			array_map( 'unregister_sidebar', $this->config[ self::UNREGISTER ] );
		}
	}
}
