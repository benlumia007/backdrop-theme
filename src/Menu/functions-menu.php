<?php
/**
 * Nav menu functions.
 *
 * Helper functions and template tags related to nav menus.
 *
 * @package   Backdrop Theme
 * @link      https://github.com/backdrop-dev/theme
 *
 * @author    Benjamin Lu
 * @copyright 2019 Benjamin Lu
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Backdrop\Theme\Menu;

/**
 * Outputs the nav menu name by theme location.
 *
 * @param string $location
 * @return void
 */
function display_name( $location ) {

    echo esc_html( render_name( $location ) );
}

/**
 * Function for grabbing a WP nav menu name based on theme location.
 *
 * @param string $location
 * @return string
 */
function render_name( $location ) {

    $locations = get_nav_menu_locations();

    $menu = isset( $locations[ $location ] ) ? wp_get_nav_menu_object( $locations[ $location ] ) : '';

    return $menu ? $menu->name : '';
}

/**
 * Outputs the nav menu theme location name.
 *
 * @param string $location
 * @return void
 */
function display_location( $location ) {
    echo esc_html( render_location( $location ) );
}

/**
 * Function for grabbing a WP nav menu theme location name.
 *
 * @param string $location
 * @return string
 */
function render_location( $location ) {

    $locations = get_registered_nav_menus();

    return $locations[ $location ] ?? '';
}