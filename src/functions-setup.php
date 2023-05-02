<?php
/**
 * Backdrop Core
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-theme
 */

/**
 * Define namespace
 */
namespace Backdrop\Theme;

function backdrop_theme_setup() {
	// Automatically add the `<title>` tag.
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\backdrop_theme_setup' ); 